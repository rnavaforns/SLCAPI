<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JugadorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class JugadorController extends AbstractController
{
    private $jugadorRepository;

    public function __construct(JugadorRepository $jugadorRepository)
    {
        $this->jugadorRepository = $jugadorRepository;
    }

    /**
     * @Route("/jugador", name="add_jugador", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $id = $data['id'];
        $gols = $data['gols'];
        $assist = $data['assist'];
        $xuts_porta = $data['xuts_porta'];
        $xuts_fora = $data['xuts_fora'];
        $perdues = $data['perdues'];
        $recuperacions = $data['recuperacions'];
        $intercepcions = $data['intercepcions'];
        $partits = $data['partits'];

        if (!isset($id) || !isset($gols) || !isset($assist) || !isset($xuts_fora)|| !isset($xuts_porta) || !isset($perdues)
            || !isset($recuperacions) || !isset($intercepcions) || !isset($partits)) {
            throw new \Exception('Expecting mandatory parameters!');
        }

        $this->jugadorRepository->saveJugador($id, $gols, $assist, $xuts_porta, $xuts_fora, $perdues, $recuperacions, $intercepcions, $partits);

        return new JsonResponse(['status' => 'Jugador created!'], Response::HTTP_CREATED);
    }

	/**
	 * @Route("/jugador/{id}", name="get_one_jugador", methods={"GET"})
	 */
	public function get($id): JsonResponse
	{
		$jugador = $this->jugadorRepository->findOneBy(['id' => $id]);

		$data = $this->getData($jugador);

		return new JsonResponse($data, Response::HTTP_OK);
	}

	/**
	 * @Route("/jugadors", name="get_all_jugadors", methods={"GET"})
	 */
	public function getAll(): JsonResponse
	{
		$jugadors = $this->jugadorRepository->findAll();
		$jugador_map = array();

		foreach ($jugadors as $jugador) {
			$jugador_map[$jugador->getId()] = $this->getData($jugador);
		}

		return new JsonResponse($jugador_map, Response::HTTP_OK);
	}

	/**
	 * @Route("/updatejugador/{id}&{accio}", name="update_jugador", methods={"PUT"})
	 */
	public function update($id, $accio): JsonResponse
	{
		$jugador = $this->jugadorRepository->findOneBy(['id' => $id]);
		$data_jugador = $this->getData($jugador);

		switch($accio) {
			case 'gols':
				$jugador->setGols(++$data_jugador['gols']);
				break;
			case 'assist':
				$jugador->setAssist(++$data_jugador['assist']);
				break;
			case 'xuts_porta':
				$jugador->setXutsPorta(++$data_jugador['xuts_porta']);
				break;
			case 'xuts_fora':
				$jugador->setXutsFora(++$data_jugador['xuts_fora']);
				break;
			case 'perdues':
				$jugador->setPerdues(++$data_jugador['perdues']);
				break;
			case 'recuperacions':
				$jugador->setRecuperacions(++$data_jugador['recuperacions']);
				break;
			case 'intercepcions':
				$jugador->setIntercepcions(++$data_jugador['intercepcions']);
				break;
			default:
				$jugador->setPartits(++$data_jugador['partits']++);
				break;
		}
		$updatedJugador = $this->jugadorRepository->updateJugador($jugador);

		return new JsonResponse($updatedJugador->toArray(), Response::HTTP_OK);
	}

	protected function getData($jugador)
	{
		return array(
			'id'=>$jugador->getId(),
			'gols'=>$jugador->getGols(),
			'assist'=>$jugador->getAssist(),
			'xuts_porta'=>$jugador->getXutsPorta(),
			'xuts_fora'=>$jugador->getXutsFora(),
			'perdues'=>$jugador->getPerdues(),
			'recuperacions'=>$jugador->getRecuperacions(),
			'intercepcions'=>$jugador->getIntercepcions(),
			'partits'=>$jugador->getPartits()
		);
	}
}
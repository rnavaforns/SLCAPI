<?php

namespace App\Controller;

use App\Repository\PartitRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PartitController 
{
	private $partitRepository;

    public function __construct(PartitRepository $partitRepository)
    {
        $this->partitRepository = $partitRepository;
    }

	/**
     * @Route("/partit", name="add_partit", methods={"POST"})
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

        if (!isset($id) || !isset($gols) || !isset($assist) || !isset($xuts_fora) || !isset($perdues)
            || !isset($recuperacions) || !isset($intercepcions)) {
            throw new \Exception('Expecting mandatory parameters!');
        }

        $this->partitRepository->savePartit($id, $gols, $assist, $xuts_porta. $xuts_fora, $perdues, $recuperacions, $intercepcions);

        return new JsonResponse(['status' => 'Partit created!'], Response::HTTP_CREATED);
    }

    /**
	 * @Route("/partit/{id}{accio}", name="update_partit", methods={"PUT"})
	 */
	public function update($id, $accio, Request $request): JsonResponse
	{
		$jugador = $this->jugadorRepository->findOneBy(['id' => $id]);
        $partit = $this->partitRepository->findOneBy([1]);
		$data_jugador = $this->getData($jugador);

		switch($accio) {
			case 'gols':
				$jugador->setGols($data_jugador['gols']++);
				break;
			case 'assist':
				$jugador->setAssist($data_jugador['assist']++);
				break;
			case 'xuts_porta':
				$jugador->setXutsPorta($data_jugador['xuts_porta']++);
				break;
			case 'xuts_fora':
				$jugador->setXutsFora($data_jugador['xuts_fora']++);
				break;
			case 'perdues':
				$jugador->setPerdues($data_jugador['perdues']);
				break;
			case 'recuperacions':
				$jugador->setRecuperacions($data_jugador['recuperacions']);
				break;
			case 'intercepcions':
				$jugador->setIntercepcions($data_jugador['intercepcions']);
				break;
			default:
				$jugador->setPartits($data_jugador['partits']++);
				break;
		}
		$updatedPartit = $this->partitRepository->updateCustomer($partit);

		return new JsonResponse($updatedPartit->toArray(), Response::HTTP_OK);
	}

    protected function getData($jugador)
	{
		return $data[] = array(
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
<?php

namespace App\Controller;

use App\Repository\PartitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PartitController extends AbstractController
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
	 * @Route("/updatepartit/{id}&{accio}", name="update_partit", methods={"PUT"})
	 */
	public function update($id, $accio): JsonResponse
	{
        $partit = $this->partitRepository->findOneBy(['id' => $id]);
		$data_partit = $this->getData($partit);

		switch($accio) {
			case 'gols':
				$partit->setGols($data_partit['gols'] + 1);
				break;
			case 'assist':
				$partit->setAssist($data_partit['assist'] + 1);
				break;
			case 'xuts_porta':
				$partit->setXutsPorta($data_partit['xuts_porta'] + 1);
				break;
			case 'xuts_fora':
				$partit->setXutsFora($data_partit['xuts_fora'] + 1);
				break;
			case 'perdues':
				$partit->setPerdues($data_partit['perdues'] + 1);
				break;
			case 'recuperacions':
				$partit->setRecuperacions($data_partit['recuperacions'] + 1);
				break;
			case 'intercepcions':
				$partit->setIntercepcions($data_partit['intercepcions'] + 1);
				break;
			default:
				break;
		}
		$updatedPartit = $this->partitRepository->updatePartit($partit);

		return new JsonResponse($updatedPartit->toArray(), Response::HTTP_OK);
	}

    protected function getData($partit)
	{
		return $data = array(
			'id'=>$partit->getId(),
			'gols'=>$partit->getGols(),
			'assist'=>$partit->getAssist(),
			'xuts_porta'=>$partit->getXutsPorta(),
			'xuts_fora'=>$partit->getXutsFora(),
			'perdues'=>$partit->getPerdues(),
			'recuperacions'=>$partit->getRecuperacions(),
			'intercepcions'=>$partit->getIntercepcions(),
		);
	}

}
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
}
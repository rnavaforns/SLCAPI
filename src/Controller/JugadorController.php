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
}
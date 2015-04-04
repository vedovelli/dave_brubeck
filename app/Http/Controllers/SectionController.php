<?php namespace App\Http\Controllers;

use \Request as Request;
use \Response as Response;

use App\Dave\Repositories\ISectionRepository as Sections;

class SectionController extends Controller
{
  protected $sectionRepository;

  function __construct(Sections $sectionRepository)
  {
    $this->sectionRepository = $sectionRepository;
  }

  public function store($id)
  {
    $this->sectionRepository->store($id, Request::all());

    return redirect()->route('project.show', ['id' => $id])->with('success', 'Seção de conteúdo criada com sucesso!');
  }

  public function destroy($project_id, $section_id)
  {
    $result = $this->sectionRepository->destroy($section_id);

    if($result)
    {
      /**
      * Retornará false se a seção contiver paginas > 0.
      * Silenciosamente retornará para detalhes do projeto
      */
      return redirect()->back();
    } else {
      return redirect()->back()->with('errors', ['Erro ao remover seção']);
    }

  }
}
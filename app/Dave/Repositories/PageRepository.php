<?php namespace App\Dave\Repositories;

use App\Models\Page;
use \DB as DB;

use IUserRepository as UserRepository;
use ISectionRepository as SectionRepository;

class PageRepository implements IPageRepository
{

  protected $userRepository;
  protected $sectionRepository;

  function __construct(IUserRepository $userRepository, ISectionRepository $sectionRepository)
  {
    $this->userRepository = $userRepository;
    $this->sectionRepository = $sectionRepository;
  }

  public function pages($search = null, $paginate = true)
  {
    return Page::where('title', 'like', "%$search%")->get();
  }

  public function show($id)
  {
    return Page::find($id);
  }

  public function store($request)
  {
    $page = new Page();
    $page->fill($request);

    $user = $this->userRepository->show($request['user_id']);
    $section = $this->sectionRepository->show($request['section_id']);

    $user->pages()->save($page);
    $section->pages()->save($page);

    return $page;
  }

  public function update($id, $request)
  {
    $page = Page::find($id);
    $page->fill($request);
    $page->save();
    return $page;
  }

  public function destroy($id)
  {
    $page = Page::find($id);
    $page->delete();
    return true;
  }
}
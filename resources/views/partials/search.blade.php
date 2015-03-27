<div class="input-group">
  <span class="input-group-btn {{$search == NULL ? 'hidden' : ''}}">
    <button class="btn btn-default search-clear" type="button" data-url="{{$route}}">limpar</button>
  </span>
  <input type="text" class="form-control search-field" placeholder="Busca: digite o termo de presisone enter" data-url="{{$route}}" value="{{$search != null ? $search : ''}}">
  <span class="input-group-btn">
    <button class="btn btn-primary search-do" type="button" data-url="{{$route}}">buscar</button>
  </span>
</div>

@section('scripts')
  <script src="/js/search.js"></script>
@endsection
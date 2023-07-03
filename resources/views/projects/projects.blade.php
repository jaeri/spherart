<x-layoutIndex>
    <div class="container">
        
        @auth
        <div class="d-flex justify-content-between mt-3"> 
            <a href="/project/create" class="btn btn-primary">Create new project</a> 
            <div>
                <form action="{{ route('projects.index') }}" method="GET">
                    <select class="form-select" name="filter" onchange="this.form.submit()">
                        <option value="user" {{ request('filter') === 'user' || !request('filter') ? ' selected' : '' }}>My Projects</option>
                        <option value="all" {{ request('filter') === 'all' ? ' selected' : '' }}>All Projects</option>
                    </select>
                </form>
            </div>
        </div>
        @endauth        
        
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>

        <script>
            $('.grid').masonry({
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        </script>
        
        <div class="row row-cols-1 row-cols-md-3 g-4 my-4" data-masonry='{"percentPosition": true }'>   
           
            @foreach ($projects as $project)
                <div class="col">
                    <div class="card">
                    <a href="/projects/{{$project->id}}">
                        <img src="{{$project->cover ? asset('storage/' . $project->cover) : asset('images/cover-no-image.png')}}" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{$project->name}}</h5>
                        <p class="card-text">
                            {{Str::limit($project->description, 70)}}
                        </p>

                        <span class="mx-2 d-block"> 
                            <a href="/collaborators/{{$project->creator_id}}">
                                <img
                                    src="{{$project->user->avatar ? asset('storage/' . $project->user->avatar) : asset('images/no-image.png')}}"
                                    class="rounded-circle"
                                    height="25"
                                    width="25"
                                    alt="Black and White Portrait of a Man"
                                    loading="lazy"
                                />                                
                                <small class="text-body">{{$project->user->nikname}}</small>
                           </a>   
                        </span>
                        
                        @if (auth()->check() && $project->creator_id === auth()->user()->id)
                            <div class="d-flex justify-content-end">
                                <a href="/projects/{{$project->id}}/add" class="btn btn-outline-secondary btn-rounded" data-mdb-ripple-color="dark">Add collaborator</a>
                                <form action="{{route('project.delete', $project) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-rounded mx-2" data-mdb-ripple-color="dark"><i class="fas fa-trash"></i></button> 
                                </form> 
                                <a href="{{route('projects.edit', $project) }}"  class="btn btn-outline-success btn-rounded" data-mdb-ripple-color="dark"><i class="fas fa-gear"></i></a>
                            </div>
                        @endif
                    </div>
                    </div>
                </div>            
            @endforeach

        </div>
    </div>
</x-layoutIndex>
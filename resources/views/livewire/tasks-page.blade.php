<div>
    <h1>The whole world belongs to you.</h1>
    <div class="row">
        @foreach ($allTasks as $t)
            <div class="card col-md-6 mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $t->image) }}" class="img-fluid rounded-start" alt="$t->title">
                    </div>
                    <div class="col-md-8 bg-rdm text-white">
                        <div class="card-header">{{ $t->contest->name }}</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $t->title }}</h5>
                            <p class="card-text">{{ $t->description }}</p>
                        </div>
                        <div class="card-footer">
                            <small class="card-text">Points</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

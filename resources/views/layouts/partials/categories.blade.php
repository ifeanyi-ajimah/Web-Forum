
          <div class="col-md-3">
                <h4><b>Category</b></h4>
            <ul class="list-group">
              <a href="{{route('thread.index')}}" class="list-group-item">
                All thread
                <span class="badge">{{ $threadCount }}</span>
              </a>
              @forelse ($threads as $thread)
              <a href="#" class="list-group-item">
                    {{ $thread->subject }}
                    
              </a>
              @empty
              <a href="#" class="list-group-item">
                    No thread yet
                    <span class="badge">2</span>
              </a>
              @endforelse


            </ul>
          </div>

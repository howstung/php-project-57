<div>
    <nav aria-label="Pagination of tasks">
        <ul class="pagination">

            <li class="page-item @disabled($currentPage - 1 <= 0) ">
                <a class="page-link" href="{{ route('task.index', ['page'=> $currentPage - 1]) }}"
                   aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            @if($currentPage >=2 )
                <li class="page-item">
                    <a class="page-link"
                       href="{{ route('task.index', ['page'=> $currentPage-1]) }}">{{ $currentPage - 1 }}</a>
                </li>
            @endif

            <li class="page-item {{ count($tasks) !==0 ? 'active' : null }}" aria-current="page">
                <a class="page-link"
                   href="{{ route('task.index', ['page'=> $currentPage]) }}">{{ $currentPage }}</a>
            </li>

            @if($currentPage < $lastPage )
                <li class="page-item">
                    <a class="page-link"
                       href="{{ route('task.index', ['page'=> $currentPage+1]) }}">{{ $currentPage + 1 }}</a>
                </li>
            @endif

            <li class="page-item @disabled($currentPage >= $lastPage) ">
                <a class="page-link" href="{{ route('task.index', ['page'=> $currentPage + 1]) }}"
                   aria-label="Previous">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>

        </ul>
    </nav>

    <div>
        <p class="text-sm text-gray-700 leading-5">
            {{ __('views.task.pagination.showing') }}
            @if(count($tasks) == 0)
                0
            @else
                {{ __('views.task.pagination.from') }}
                <span class="font-medium">{{ ($currentPage-1) * $perPage + 1 }}</span>
                {{ __('views.task.pagination.to') }}
                <span class="font-medium">{{ min($total, ($currentPage-1) * $perPage +  $perPage) }}</span>
            @endif

            {{ __('views.task.pagination.of') }}
            <span class="font-medium">{{ $total }}</span>
        </p>
    </div>

</div>

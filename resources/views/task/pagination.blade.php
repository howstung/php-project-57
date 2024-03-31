<div>
    <nav aria-label="Pagination of tasks">
        <ul class="pagination">

            <li class="page-item {{ $currentPage - 1 <= 0 ? 'disabled' : null }}">
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

            <li class="page-item {{ $currentPage >= $lastPage ? 'disabled' : null }}">
                <a class="page-link" href="{{ route('task.index', ['page'=> $currentPage + 1]) }}"
                   aria-label="Previous">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <div>
        <p class="text-sm text-gray-700 leading-5">
            Показаны
            @if(count($tasks) == 0)
                0
            @else
                с
                <span class="font-medium">{{ ($currentPage-1) * $perPage + 1 }}</span>
                по
                <span class="font-medium">{{ min($total, ($currentPage-1) * $perPage +  $perPage) }}</span>
            @endif

            из
            <span class="font-medium">{{ $total }}</span>


        </p>
    </div>

</div>

{!! Form::open(['route' => 'search-users', 'method' => 'POST', 'role' => 'form', 'class' => 'common-search-form clearfix', 'id' => 'search-users-form']) !!}
    {!! csrf_field() !!}
    <div class="search-form-group right">
        <div class="search_input">
            {!! Form::text('user-search', NULL, ['id' => 'user-search-input', 'class' => 'form-input', 'required' => false]) !!}
            <span class="clear-search"></span>
        </div>
        <button type="button" id="user-search-trigger">
            <i class="fa fa-search fa-fw" aria-hidden="true"></i>
            <span>検索</span>
        </button>
    </div>
{!! Form::close() !!}
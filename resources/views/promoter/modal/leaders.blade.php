     <div class="modal-header">
        <span class="icon">🏆</span>
        <h5 class="modal-title">Таблица лидеров месяца</h5>
        @if($top_users != null)
        <h6>Вы на {{ $level }} месте</h6>
        @else
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal_table">
          @if($top_users != null)
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Город</th>
                <th scope="col">Кол-во бонусов</th>
              </tr>
            </thead>
            <tbody>
              @foreach($top_users as $top_user)
              @if ($loop->iteration == $level)<tr class="me">@else<tr>@endif

                @if($loop->iteration == 1)
                <th scope="row" style="font-size: 24px;">🥇</th>
                @elseif($loop->iteration == 2)
                <th scope="row" style="font-size: 24px;">🥈</th>
                @elseif($loop->iteration == 3)
                <th scope="row" style="font-size: 24px;">🥉</th>
                @else
                <th scope="row">{{ $loop->iteration }}</th>
                @endif
                
                <td>{{ $top_user->fio}}</td>
                <td>{{ $top_user->city}}</td>
                <td>{{ $top_user->bonus}} б.</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <p>В этом месяце еще нет лидеров.</p>
          @endif
        </div>
      </div>
      <!-- <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Назад</button>
          </div> -->

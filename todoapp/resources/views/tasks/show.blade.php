@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスク詳細を表示する</div>
          <div class="panel-body">
            <!-- <form>//formが悪さをしていたみたいなので、14行目からのformをコメントアウト -->
              <div class="form-group">
                <label for="title">タイトル</label>
                <p>  {{ $task->title }} </p>
              </div>
              <div class="form-group">
                <label for="detail">詳細</label>
                <p>  {{ $task->detail }} </p>
              </div>
              <div class="form-group">
                <label for="due_date">期限</label>
                 <p>  {{ $task->formatted_due_date }} </p>
              </div>
              <div class="form-group">
                <label for="status">状態</label>
                <p>{{ $task->status_label }}</p>
              </div>
              <div class="form-group">
                <label for="pending_time">保留時間</label>
                 <p>  <?php if (is_int($task->pending_time) == false && $task->pending_time == null){
                                echo "まだ取り掛かってないタスクがあるよ、、、";
                            }
                            if ($task->pending_time >= 1){
                                echo "作業保留時間が" . $task->pending_time . "時間あったよ";
                            }
                            if (is_int($task->pending_time) == true && $task->pending_time < 1){
                                echo "1時間以内に着手出来たよ！";
                            }
                  ?> </p>
              </div>
              <div class="form-group">
                <label for="work_time">作業時間</label>
                 <p>  <?php if (is_int($task->work_time) == true && $task->work_time == null){
                                echo "まだ完了していないタスクがあるよ、、、";
                            }
                            if ($task->work_time > 6){
                                echo "完了までに" . $task->work_time . "時間かかってしまったよ";
                            }
                            if ($task->work_time < 6 && $task->work_time >= 1){
                                echo "完了までに" . $task->work_time . "時間だったよ。";
                            }
                            if (is_int($task->work_time) == true && $task->work_time < 1){
                                echo "1時間以内にタスク完了できたよ！";
                            }
                  ?> </p>
              </div>
              <div class="form-group">
                <label for="assigner_id">クライアント</label>
                <p>  {{ $user->name }} </p>
              </div>
              <div class="text-right">
                <input type="button" class="btn btn-primary" onclick="history.back()" value="戻る">
                <!-- actionに波カッコがついていなかったので追加 -->
                <form method="post" action="{{ route('tasks.delete', [$task->id]) }}">
               {{ csrf_field() }}
                  <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("本当に削除しますか？");'>
               </form>
              </div>
            <!-- </form>//formが悪さをしていたみたいなので、14行目からのformをコメントアウト -->
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  @include('share.flatpickr.scripts')
@endsection
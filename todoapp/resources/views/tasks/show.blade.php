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
            <form>
              @csrf
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
                                echo "まだ取り掛かってない作業があるみたい、、、";
                            }
                            if ($task->pending_time >= 3){
                                echo $task->pending_time . "時間でようやくスタート、、、ここから巻き返そう！";
                            }
                            if (is_int($task->pending_time) == true && $task->pending_time < 3){
                                echo $task->pending_time . "時間でタスク開始！いいペースだね★";
                            }
                  ?> </p>
              </div>
              <div class="form-group">
                <label for="work_time">作業時間</label>
                 <p>  <?php if (is_int($task->work_time) == true && $task->work_time == null){
                                echo "お仕事、早く終わるといいね、、、";
                            }
                            if ($task->work_time > 6){
                                echo $task->work_time . "時間もかかっちゃったね。難しいお仕事だったのかな、、、？";
                            }
                            if ($task->work_time < 6 && $task->work_time > 3){
                                echo $task->work_time . "時間のお仕事お疲れ様！順調なペースだったよ★";
                            }
                            if (is_int($task->work_time) == true && $task->work_time < 3){
                                echo $task->work_time . "時間で達成だね！お疲れ様☆";
                            }
                  ?> </p>
              </div>
              <div class="form-group">
                <label for="assigner_id">クライアント</label>
                <p>  {{ $task->assigner_id }} </p>
              </div>
              <div class="text-right">
                <input type="button" class="btn btn-primary" onclick="history.back()" value="戻る">
               <!-- <form method="post" action="#">
                @csrf
                  <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("本当に削除しますか？");'> -->
                </form>
                </form>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  @include('share.flatpickr.scripts')
@endsection
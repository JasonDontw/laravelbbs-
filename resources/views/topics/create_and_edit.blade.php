@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">

        <div class="card-body">
          <h2 class="">
            <i class="far fa-edit"></i>
            @if($topic->id)
            編輯話題
            @else
            新建話題
            @endif
          </h2>

          <hr>

          @if($topic->id)
            <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PUT">
          @else
            <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
          @endif

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              @include('shared._error')

              <div class="form-group">
                <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="請填寫標題" required />
              </div>

              <div class="form-group">
                <select class="form-control" name="category_id" required>
                  <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>請選擇分類</option>
                    @foreach ($categories as $value)
                      <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>
                        {{ $value->name }}
                      </option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <textarea name="body" class="form-control" id="editor" rows="6" placeholder="請填入至少三個字符的內容。" required>{{ old('body', $topic->body ) }}</textarea>
              </div>

              <div class="well well-sm">
                <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

  <script>
    $(document).ready(function() {
      var editor = new Simditor({
        textarea: $('#editor'),
        upload: {
          url: '{{ route('topics.upload_image') }}',
          params: {
            _token: '{{ csrf_token() }}'
          },
          fileKey: 'upload_file',
          connectionCount: 3,
          leaveConfirm: '文件上傳中，關閉此頁面將取消上傳。'
        },
        pasteImage: true,
      });
    });
  </script>
@stop

<!--
  placeholder（默認值：''）編輯器的 placeholder，如果為空 Simditor 會取 textarea 的 placeholder 屬性；
  toolbar （默認值：true）是否顯示工具欄按鈕；
  toolbarFloat （默認值：true）是否讓工具欄按鈕在頁面滾動的過程中始終可見；
  toolbarHidden （默認值：false）是否隱藏工具欄，隱藏後 toolbarFloat 會失效；
  defaultImage（默認值：'images/image.png'）編輯器插入混排圖片時使用的默認圖片；
  tabIndent（默認值：true）是否在編輯器中使用 tab 鍵來縮進；
  params（默認值：{}）鍵值對，在編輯器中增加 hidden 字段（input:hidden），通常用於生成 form 表單的默認參數；
  upload（默認值：false）false 或者鍵值對，編輯器上傳本地圖片的配置，常用的屬性有 url 和 params；
  pasteImage（默認值：false）是否允許粘貼上傳圖片，依賴 upload 選項，僅支持 Firefox 和 Chrome 瀏覽器。
  url —— 處理上傳圖片的URL；
  fileKey——是服務器端獲取圖片的鍵值，我們設置為upload_file;
  connectionCount —— 最多只能同時上傳3 張圖片；
  leaveConfirm —— 上傳過程中，用戶關閉頁面時的提醒。
 -->
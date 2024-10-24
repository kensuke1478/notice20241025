<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <header>
            <title>お知らせ一覧</title>
    </head>
    <body>
        <!--お知らせ一覧の検索後入力処理-->
        <form action="{{ url('notice') }}" method="GET" novalidate>
            @csrf
            <div class="seatch" style="width:auto">
                @foreach ($errors->all() as $error)
                <p name = "error" class="error__message text-center text-danger">{{$error}}</p>
                @endforeach
                <th>お知らせタイトル</th>
                <td><input type="text" name="keyword"></td>
                <th>お知らせ区分</th>
                <select name="kbn" class="form-control">
                    @foreach (Config::get('information.information_kbn') as $key => $val)
                    <option value="{{ $key }}" name="information_kbn" value="{{ old('kbn') }}">{{ $val }}</option>
                    @endforeach
                </select>
                <br>
                <th>掲載日</th>
                <td><input type="text" name="keyword"></td>
                <th>運用期間</th>
                <td><input type="text" name="keyword"></td> 〜 <td><input type="text" name="keyword"></td>
                <td><input type="submit" value="検索"></td>
            </div>
            </header>
            <!--お知らせ一覧の検索後出力処理-->
            <table>
                <tr class="kensaku">
                    <th>検索結果 {{ $notices->appends(request()->input())->links('vendor.pagination.semantic-ui') }}</th>
                </tr>
                <tr class="title">
                    <th class="lavel">
                        <span class="title">お知らせタイトル</span>
                        <span class="kbn_kbn">お知らせ区分</span>
                        <span class="keisai_keisai">掲載日</span>
                        <span class="kikan_kikan">適用期間</span>
                    </th>
                </tr>
                @foreach ($notices as $notice)
                <tr class="kakunin">
                    <td class="kakunin">
                        <input type="radio" id="scales" name="scales" checked />
                        <label for="scales">
                            <span class="title">{{$notice -> information_title}}</span>
                            @if($notice -> information_kbn == 1)
                                <span class="kbn">重要</span>
                            @else
                                <span class="kbn">情報</span>
                            @endif
                            <span class="keisai">{{ date('Y/m/d',strtotime($notice -> keisai_ymd))}}</span>
                            <span class="kikan">{{ date('Y/m/d',strtotime($notice -> enable_start_ymd))}} ~ {{ date('Y/m/d',strtotime($notice -> enable_end_ymd))}}</span>
                        </label>
                    </td>
                </tr>
                @endforeach
            </table>
        </form>
            <!--ボタン機能-->
            <div class="button">
                <button><a href="{{url('notice/add')}}" class="btn btn-success">登録</a></button>
                @foreach ($notices as $notice)
                @if($loop->first)
                <button><a href="{{ url('notice/' . $notice->information_id . '/edit') }}">修正</a></button>
                @endif
                <form action="{{ url('notice/' . $notice->information_id) }}" method="post" novalidate>
                    {{ csrf_field() }}
                    @if($loop->first)
                    <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                    <!--削除ダイアログ処理-->
                    <script>
                        $(function () {
                            $(".btn-dell").click(function () {
                                if (confirm("本当に削除しますか？")) {
                                    confirm("削除が完了しました。");
                                } else {
                                    return false;
                                }
                            });
                        });
                    </script>
                </form>
                @endif
                @endforeach
            </div>
    </body>
</html>

jQuery( function() {
    // スケジュール管理用カレンダー表示実行
    doCalender2();
} );

// スケジュール管理用カレンダー表示
function doCalender() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear(); 

    // Documentの読み込みが完了するまで待機し、カレンダーを初期化します。
    $('#calendar').fullCalendar({
        // ヘッダーのタイトルとボタン
        header: {
            // title, prev, next, prevYear, nextYear, today
            left: 'prev,next today',
            center: 'title',
            right: 'month agendaWeek agendaDay'
        },
        editable: true,
        // jQuery UI theme
        theme: false,
        // 最初の曜日
        firstDay: 1, // 1:月曜日
        // 土曜、日曜を表示
        weekends: true,
        // 週モード (fixed, liquid, variable)
        weekMode: 'fixed',
        // 週数を表示
        weekNumbers: false,
        // 高さ(px)
        //height: 700,
        // コンテンツの高さ(px)
        //contentHeight: 600,
        // カレンダーの縦横比(比率が大きくなると高さが縮む)
        //aspectRatio: 1.35,
        // ビュー表示イベント
        viewDisplay: function(view) {
            //alert('ビュー表示イベント ' + view.title);
        },
        // ウィンドウリサイズイベント
        windowResize: function(view) {
            //alert('ウィンドウリサイズイベント');
        },
        // 日付クリックイベント
        dayClick: function () {
            //alert('日付クリックイベント');
        },
        // 初期表示ビュー
        defaultView: 'month',
        // 終日スロットを表示
        allDaySlot: true,
        // 終日スロットのタイトル
        allDayText: '終日',
        // スロットの時間の書式
        axisFormat: 'H(:mm)',
        // スロットの分
        slotMinutes: 15,
        // 選択する時間間隔
        snapMinutes: 15,
        // TODO よくわからない
        //defaultEventMinutes: 120,
        // スクロール開始時間
        firstHour: 9,
        // 最小時間
        minTime: 6,
        // 最大時間
        maxTime: 20,
        // 表示する年
        year: 2012,
        // 表示する月
        month: 12,
        // 表示する日
        day: 31,
        // 時間の書式
        timeFormat: 'H(:mm)',
        // 列の書式
        columnFormat: {
            month: 'ddd',    // 月
            week: "d'('ddd')'", // 7(月)
            day: "d'('ddd')'" // 7(月)
        },
        // タイトルの書式
        titleFormat: {
            month: 'yyyy年M月',                             // 2013年9月
            week: "yyyy年M月d日{ ～ }{[yyyy年]}{[M月]d日}", // 2013年9月7日 ～ 13日
            day: "yyyy年M月d日'('ddd')'"                  // 2013年9月7日(火)
        },
        // ボタン文字列
        buttonText: {
            prev:     '&lsaquo;', // <
            next:     '&rsaquo;', // >
            prevYear: '&laquo;',  // <<
            nextYear: '&raquo;',  // >>
            today:    '今日',
            month:    '月',
            week:     '週',
            day:      '日'
        },
        // 月名称
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 月略称
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 曜日名称
        dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
        // 曜日略称
        dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
        // 選択可
        selectable: true,
        // 選択時にプレースホルダーを描画
        selectHelper: true,
        // 自動選択解除
        unselectAuto: true,
        // 自動選択解除対象外の要素
        unselectCancel: '',
        // イベントソース
        eventSources: [
            {
                events: [
                    {
                        title: 'event1',
                        start: '2013-01-01'
                    },
                    {
                        title: 'event2',
                        start: '2013-01-02',
                        end: '2013-01-03'
                    },
                    {
                        title: 'event3',
                        //start: '2013-01-05 12:30:00',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 16, 0),
                        allDay: false // will make the time show
                    }
                ]
            }
        ]
    });
    // 動的にオプションを変更する
    //$('#calendar').fullCalendar('option', 'height', 700);
 
    // カレンダーをレンダリング。表示切替時などに使用
    //$('#calendar').fullCalendar('render');
 
    // カレンダーを破棄（イベントハンドラや内部データも破棄する）
    //$('#calendar').fullCalendar('destroy')
}

// スケジュール管理用カレンダー表示
function doCalender2() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
            theme: true,
            header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            events: [
                    {
                            title: 'All Day Event',
                            start: new Date(y, m, 1)
                    },
                    {
                            title: 'Long Event',
                            start: new Date(y, m, d-5),
                            end: new Date(y, m, d-2)
                    },
                    {
                            id: 999,
                            title: 'Repeating Event',
                            start: new Date(y, m, d-3, 16, 0),
                            allDay: false
                    },
                    {
                            id: 999,
                            title: 'Repeating Event',
                            start: new Date(y, m, d+4, 16, 0),
                            allDay: false
                    },
                    {
                            title: 'Meeting',
                            start: new Date(y, m, d, 10, 30),
                            allDay: false
                    },
                    {
                            title: 'Lunch',
                            start: new Date(y, m, d, 12, 0),
                            end: new Date(y, m, d, 14, 0),
                            allDay: false
                    },
                    {
                            title: 'Birthday Party',
                            start: new Date(y, m, d+1, 19, 0),
                            end: new Date(y, m, d+1, 22, 30),
                            allDay: false
                    },
                    {
                            title: 'Click for Google',
                            start: new Date(y, m, 28),
                            end: new Date(y, m, 29)/*,
                            url: 'http://google.com/'*/
                    }
            ],
        // 最初の曜日
        firstDay: 1, // 1:月曜日
        // 土曜、日曜を表示
        weekends: true,
        // 週モード (fixed, liquid, variable)
        weekMode: 'fixed',
        // 週数を表示
        weekNumbers: false,
        // 高さ(px)
        //height: 700,
        // コンテンツの高さ(px)
        //contentHeight: 600,
        // カレンダーの縦横比(比率が大きくなると高さが縮む)
        //aspectRatio: 1.35,
        // ビュー表示イベント
        viewDisplay: function(view) {
            //alert('ビュー表示イベント ' + view.title);
        },
        // ウィンドウリサイズイベント
        windowResize: function(view) {
            //alert('ウィンドウリサイズイベント');
        },
        // 日付クリックイベント
        dayClick: function () {
            //alert('日付クリックイベント');
        },
        /*
        dayClick: function(date, allDay, jsEvent, view) {
            if (allDay) {
                alert('Clicked on the entire day: ' + date);
            }else{
                alert('Clicked on the slot: ' + date);
            }
            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            alert('Current view: ' + view.name);
            // change the day's background color just for fun
            $(this).css('background-color', 'red');
        },*/
        // イベントクリックイベント（要調整）
        eventClick: function(calEvent, jsEvent, view) {
            var note = 'イベント: ' + calEvent.title + '<br>' +
                       'マウス位置: ' + jsEvent.pageX + ',' + jsEvent.pageY + '<br>' +
                       'カレンダーモード: ' + view.name + '<br>' +
                       '開始日：' + calEvent.start + '<br>' +
                       '終了日：' + calEvent.end;
            // change the border color just for fun
            //$(this).css('border-color', 'red');
            $('.fc-event').css('background-color', '#3A87AD');
            $(this).css('background-color', 'red');
            $('#detail_area').html(note);
        },
        // ダブルクリックイベント（要調整）
        eventDblClick: function(calEvent, jsEvent, view) {

            //alert('Event: ' + calEvent.title);
            //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            //alert('View: ' + view.name);

            // change the border color just for fun
            $(this).css('background-color', 'blue');

        },
        // 初期表示ビュー
        defaultView: 'month',
        // 終日スロットを表示
        allDaySlot: true,
        // 終日スロットのタイトル
        allDayText: '終日',
        // スロットの時間の書式
        axisFormat: 'H(:mm)',
        // スロットの分
        slotMinutes: 15,
        // 選択する時間間隔
        snapMinutes: 15,
        // TODO よくわからない
        //defaultEventMinutes: 120,
        // スクロール開始時間
        firstHour: 9,
        // 最小時間
        minTime: 6,
        // 最大時間
        maxTime: 20,
        // 表示する年
//        year: 2012,
        // 表示する月
//        month: 12,
        // 表示する日
//        day: 31,
                
        // 時間の書式
//        timeFormat: 'H(:mm)',
        // 列の書式
        columnFormat: {
            month: 'ddd',    // 月
            week: "d'('ddd')'", // 7(月)
            day: "d'('ddd')'" // 7(月)
        },
        // タイトルの書式
        titleFormat: {
            month: 'yyyy年M月',                             // 2013年9月
            week: "yyyy年M月d日{ ～ }{[yyyy年]}{[M月]d日}", // 2013年9月7日 ～ 13日
            day: "yyyy年M月d日'('ddd')'"                  // 2013年9月7日(火)
        },
        // ボタン文字列
        buttonText: {
            prev:     '&lsaquo;', // <
            next:     '&rsaquo;', // >
            prevYear: '&laquo;',  // <<
            nextYear: '&raquo;',  // >>
            today:    '今日',
            month:    '月',
            week:     '週',
            day:      '日'
        },
        // 月名称
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 月略称
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 曜日名称
        dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
        // 曜日略称
        dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
        // 選択可
        selectable: true,
        // 選択時にプレースホルダーを描画（ドラッグによるイベント範囲指定）
        selectHelper: true,
        // 選択時のイベント（新規イベント追加：要調整）
        select: function(start, end, allDay) {
                var title = prompt('Event Title:');//タイトル入力

                if (title) {//タイトルの入力があるとき

                        //new_id++;//test id

                        //イベントの登録 renderEventメソッド
                        //http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/
                        $('#calendar').fullCalendar('renderEvent',
                                {
                                        //id: new_id,
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay
                                },
                                true // make the event "stick"
                        );
                }
                //選択解除　A method for programmatically clearing the current selection.
                //http://arshaw.com/fullcalendar/docs/selection/unselect_method/
                $('#calendar').fullCalendar('unselect');
        },
        // ドラッグ完了時イベント
        eventDragStop: function() {
            $('.fc-event').css('background-color', '#3A87AD');
            $('#detail_area').html('');
        },
        // リサイズ完了時イベント
        eventResize: function() {
            $('.fc-event').css('background-color', '#3A87AD');
            $('#detail_area').html('');
        },
        // 自動選択解除
        //unselectAuto: true,
        // 自動選択解除対象外の要素
        unselectCancel: ''

    });
}
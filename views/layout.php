<!DOCTYPE html>
<html lang="ja">
<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta charset="UTF-8">
	<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/css/import.css" rel="stylesheet">
        <script type="text/javascript" src="/js/jquery-1.10.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="/js/common.js" charset="utf-8"></script>
        <?php if(isset($head) && count($head) > 0): ?>
            <?php foreach ($head as $key => $val): ?>
                <?php echo $val; ?>
            <?php endforeach; ?>
        <?php endif; ?>
	<title><?php if (isset($title)): echo $this->escape($title) . ' - ';
		endif; ?>PlayRoomShare</title>
</head>
<body id="body">
	<div class="container">
            <div class="row">
                <div id="header">
                    <div class="span4">
                        <h1><a href="<?php echo $base_url; ?>">PlayRoomShare</a></h1>
                    </div>
                    <div class="span8">
                        <ul class="breadcrumb" id="headmenu">
                            <?php echo $this->render('topmenu'); ?>
                        </ul>
                    </div>
                </div>
                <div class="span8">
                    <div id="newsfeed">
                        <table class="table table-condensed table-hover">
                        <tr>
                            <th colspan="5">ニュースフィード</th>
                        </tr>
                        <tr>
                            <td><span class="label label-important">new</span></td>
                            <td><span class="label label-info">Info</span></td>
                            <td>管理人</td>
                            <td>03/13 23:25:15</td>
                            <td>ニュースフィールドを追加</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span class="label label-info">Info</span></td>
                            <td>管理人</td>
                            <td>03/12 23:25:15</td>
                            <td>twitter bootstrapの実装</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><span class="label label-info">Info</span></td>
                            <td>管理人</td>
                            <td>03/11 23:25:15</td>
                            <td>PHPフレームワークの実装</td>
                        </tr>
                        </table>
                    </div>
                </div>
                <div class="span4">
                    <div id="accesscounter">
                        
                        <table class="table table-condensed">
                            <tr>
                                <th colspan="3">アクセスカウンタ</th>
                            </tr>
                            <tr>
                                <th>Today</th>
                                <th>Yesterday</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <td>10 IP</td>
                                <td>5 IP</td>
                                <td>30 IP</td>
                            </tr>
                            <tr>
                                <td>20 PV</td>
                                <td>10 PV</td>
                                <td>120 PV</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <span id="sidemenu_ctr">隠す＜＜</span><br>
            <div id="sidemenu">
                <ul class="unstyled">
                    <?php echo $this->render('topmenu', array('sidemenu' => TRUE)); ?>
                </ul>
            </div>
            <div id="main">
                    <?php echo $_content; ?>
            </div>
            <div class="row">
                <div id="footer">
                    <div class="span12">
                        <ul class="breadcrumb" id="footmenu">
                            <?php echo $this->render('topmenu'); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	
</body>
</html>
<?php
/*
 * ログインが必要な場所でログインされていなかった時に呼ばれる例外処理クラス
 */
class UnauthorizedActionException extends Exception {}
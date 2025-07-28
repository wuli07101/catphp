#!/bin/sh

# 启动 cat-agent 在后台运行
#nohup /cat/cat-agent -config=/cat/configs/config.json >/dev/null 2>&1 &

# 启动 php-fpm 作为主进程
exec php-fpm
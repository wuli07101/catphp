# 基础镜像
FROM php:7.4-fpm-alpine3.16

# 安装依赖
RUN apk add --no-cache tzdata redis \
    && cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo "Asia/Shanghai" > /etc/timezone

# 安装 redis 扩展
RUN docker-php-ext-install sockets \
    && pecl install redis \
    && docker-php-ext-enable redis

# 拷贝 cat_hook.so 到扩展目录（请确保构建上下文有该文件）
COPY cat/cat_hook.so /usr/local/lib/php/extensions/no-debug-non-zts-20190902/cat_hook.so

# 配置 cat_hook.so 扩展
COPY cat/configs/docker-php-ext-cat.ini /usr/local/etc/php/conf.d/docker-php-ext-cat.ini

# 创建共享内存目录和文件
RUN mkdir -p /cat \
    && touch /cat/cat_trace_shm

# 拷贝 cat-agent 可执行文件及配置
COPY cat/cat-agent /cat/cat-agent
COPY cat/configs/config.json /cat/configs/config.json

# 赋予 cat-agent 执行权限
RUN chmod +x /cat/cat-agent

# 容器启动时仅启动 php-fpm，cat-agent 建议用 supervisor 或外部方式管理
CMD ["php-fpm"]

# 端口（如有 web 访问需求）
EXPOSE 9000 
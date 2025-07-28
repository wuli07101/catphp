# 基础镜像
FROM php:7.4-fpm-alpine3.16

# 获取构建架构参数
ARG TARGETARCH

# 安装依赖
RUN apk add --no-cache tzdata \
    && cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo "Asia/Shanghai" > /etc/timezone

# 创建必要目录
RUN mkdir -p /cat /app \
    && touch /cat/cat_trace_shm

# 拷贝架构相关文件
COPY cat/${TARGETARCH}/cat_hook.so /usr/local/lib/php/extensions/no-debug-non-zts-20190902/cat_hook.so
COPY cat/${TARGETARCH}/cat-agent /cat/cat-agent
COPY cat/configs/config.json /cat/configs/config.json
COPY ini/docker-php-ext-cat.ini /usr/local/etc/php/conf.d/docker-php-ext-cat.ini
COPY start.sh /app/start.sh

# 赋予执行权限
RUN chmod +x /cat/cat-agent /app/start.sh

# 设置工作目录
WORKDIR /app

# 容器启动时启动 cat-agent 和 php-fpm
CMD ["/app/start.sh"]

# 端口（如有 web 访问需求）
EXPOSE 9000 
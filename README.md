# 🚀 CATPHP - PHP分布式链路追踪解决方案

[![Docker](https://img.shields.io/badge/Docker-Multi--Arch-blue?logo=docker)](https://hub.docker.com/u/wuli07101)
[![PHP](https://img.shields.io/badge/PHP-7.4%20%7C%208.4-777BB4?logo=php)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 📖 项目简介

**CATPHP** 是一个基于 C 扩展的 PHP 分布式链路追踪解决方案，通过零侵入的方式实现对 PHP 应用的全面监控。本项目提供了完整的 Docker 化部署方案，支持多架构（AMD64/ARM64），让您能够快速体验和部署 CATPHP 监控系统。

## ✨ 核心特性

### 🎯 零侵入监控
- **无需修改代码**：通过 C 扩展实现函数 Hook，业务代码零修改
- **自动监控**：自动捕获 Redis、MySQL、curl、Memcached 等组件调用
- **性能损耗极低**：C 语言实现，监控开销几乎可忽略

### 🔍 全链路追踪
- **分布式追踪**：支持跨服务的完整链路追踪
- **微秒级精度**：函数执行时间精确到微秒级别
- **异常捕获**：自动捕获和上报 Fatal Error、异常等

### 🏗️ 高性能架构
- **Golang 上报器**：采用 Go 语言重写的高性能数据上报组件
- **共享内存通信**：基于共享内存的零拷贝数据传输
- **多版本兼容**：支持 PHP 7.0 到 PHP 8.x 全版本

## 🐳 Docker 镜像

本项目提供了预构建的多架构 Docker 镜像：

- **PHP 7.4**: `wuli07101/catphp-7.4-fpm-alpine3.16:1.0.0`
- **PHP 8.4**: `wuli07101/catphp-8.4-fpm-alpine3.22:1.0.0`
- **CAT 服务器**: `meituaninc/cat:3.0.1`

支持架构：
- `linux/amd64` (Intel/AMD 64位)
- `linux/arm64` (ARM 64位，包括 Apple Silicon)

## 🚀 快速开始

### 1. 克隆项目

```bash
git clone <your-repository-url>
cd catphp
```

### 2. 选择 PHP 版本并启动

#### PHP 8.4 版本（推荐）

```bash
cd php-8.4-fpm-alpine3.22
docker-compose up -d
```

#### PHP 7.4 版本

```bash
cd php-7.4-fpm-alpine3.16
docker-compose up -d
```

### 3. 访问应用

- **PHP 8.4 应用**: http://localhost
- **PHP 7.4 应用**: http://localhost
- **CAT 监控面板**: http://localhost:8080

## 📁 项目结构

```
catphp/
├── php-7.4-fpm-alpine3.16/          # PHP 7.4 版本
│   ├── Dockerfile                   # PHP 7.4 镜像构建文件
│   ├── docker-compose.yml           # 完整服务编排
│   ├── start.sh                     # 容器启动脚本
│   ├── nginx.conf                   # Nginx 配置
│   ├── www/                         # Web 根目录
│   └── cat/                         # CAT 相关配置
│       ├── amd64/                   # AMD64 架构文件
│       ├── arm64/                   # ARM64 架构文件
│       └── configs/                 # 配置文件
├── php-8.4-fpm-alpine3.22/          # PHP 8.4 版本
│   └── ...                          # 结构同上
└── README.md                        # 项目说明
```

## 🔧 配置说明

### CAT 配置

CAT 客户端配置文件位于 `cat/configs/config.json`：

```json
{
    "shm_path": "/cat/cat_trace_shm",
    "cat_servers": [
        {"host": "cat-server", "port": 2280}
    ],
    "debug": false
}
```

### Docker Compose 服务

每个版本的 `docker-compose.yml` 包含以下服务：

- **php-fpm**: PHP-FPM 服务（集成 CATPHP 扩展）
- **nginx**: Web 服务器
- **cat-mysql**: CAT 数据库
- **cat**: CAT 监控服务器

## 🛠️ 自定义构建

如果需要自定义构建镜像：

```bash
# 构建多架构镜像
docker buildx build --platform linux/amd64,linux/arm64 \
  -t your-registry/catphp-8.4-fpm:latest \
  --push .
```

## 📊 监控功能

### 支持的组件监控

- **数据库**: PDO、MySQL
- **缓存**: Redis、Memcached  
- **HTTP**: curl 请求
- **消息队列**: RabbitMQ
- **异常**: Fatal Error、Exception

### 监控数据

- 函数执行时间
- 参数和返回值
- 异常信息
- 分布式链路 ID
- 性能指标

## 🔍 故障排除

### 常见问题

1. **CAT Agent 启动失败**
   - 检查共享内存权限
   - 查看日志：`docker logs <container-name>`

2. **多架构支持问题**
   - 确保 Docker 支持 buildx
   - 检查镜像架构：`docker manifest inspect <image>`

3. **端口冲突**
   - PHP 7.4: 端口 8074
   - PHP 8.4: 端口 80
   - CAT: 端口 8080

## 🤝 贡献指南

欢迎提交 Issue 和 Pull Request！

1. Fork 项目
2. 创建特性分支
3. 提交更改
4. 推送到分支
5. 创建 Pull Request

## 📄 许可证

本项目采用 MIT 许可证 - 查看 [LICENSE](LICENSE) 文件了解详情。

## 🔗 相关链接

- **官方网站**: https://www.catphp.com
- **Docker Hub**: https://hub.docker.com/u/wuli07101
- **CAT 官方**: https://github.com/dianping/cat

---

*如果这个项目对您有帮助，请给我们一个 ⭐️！*

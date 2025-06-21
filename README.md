# Upyun PHP SDK (Unofficial Fork for PHP 8.3 & Laravel 12)

[![test](https://github.com/ltqio/upyun-php-sdk/actions/workflows/test.yml/badge.svg)](https://github.com/ltqio/upyun-php-sdk/actions/workflows/test.yml)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/g/ltqio/upyun-php-sdk/?branch=master)

[![Latest Stable Version](https://poser.pugx.org/ltqio/upyun-php-sdk/v/stable)](https://packagist.org/packages/ltqio/upyun-php-sdk)
[![Total Downloads](https://poser.pugx.org/ltqio/upyun-php-sdk/downloads)](https://packagist.org/packages/ltqio/upyun-php-sdk)


> ⚠️ **免责声明 / DISCLAIMER：本仓库为非官方维护版本**

本项目基于官方 [`upyun/php-sdk`](https://github.com/upyun/php-sdk) 进行修改，主要用于适配：
- PHP 8.3+
- Laravel 12+
- Guzzle 7+


📝 查看完整更新日志：[CHANGELOG.md](CHANGELOG.md)


**本项目与又拍云官方无直接关系，不代表官方立场或技术支持。请谨慎用于生产环境。**
如需官方版本请访问：[https://github.com/upyun/php-sdk](https://github.com/upyun/php-sdk)

---

 

又拍云 PHP SDK，封装了[又拍云功能丰富的开放 API](http://docs.upyun.com/api/) ，帮助开发者快速对接文件云端存储、图片音视频云处理、智能鉴黄等功能

- [功能列表](#list)
- [使用说明](#use-instructions)
  - [安装](#install)
  - [文档](#doc)
  - [示例](#usage)
- [贡献代码](#contribute)
- [社区](#community)
- [许可证](#license)


<a name="list"></a>
## 功能列表

SDK 包含如下功能

- 基于 [rest api](http://docs.upyun.com/api/rest_api/)
    - 文件上传下载、目录创建删除等云存储基本操作
    - [断点续传](http://docs.upyun.com/api/rest_api/#_3)
- 基于 [form api](http://docs.upyun.com/api/form_api/)
    - 文件客户端上传 见`examples/client-upload`
    - 上传预处理操作
        - [同步音频处理](http://docs.upyun.com/cloud/sync_audio/)
        - [文档转换](http://docs.upyun.com/cloud/uconvert/)
        - [异步图片音视频处理](http://docs.upyun.com/api/form_api/#_7)
        - [异步图片智能鉴黄](http://docs.upyun.com/ai/audit/)
- [异步云处理](http://docs.upyun.com/cloud/)
    - [视频音频](http://docs.upyun.com/cloud/av/)异步转码、切片、截图、水印、剪辑、拼接等功能
    - [文件异步解压缩](http://docs.upyun.com/cloud/unzip/)
    - [文件异步拉取](http://docs.upyun.com/cloud/spider/)
    - [异步图片拼接](http://docs.upyun.com/cloud/async_image/)
- [同步视频处理](http://docs.upyun.com/cloud/sync_video/)：m3u8 文件同步拼接剪辑、其他视频文件同步截图功能
- [缓存刷新](http://docs.upyun.com/api/purge/)

*功能列表中的异步操作，均可以设置异步回调通知地址，接收异步处理结果*
*如果需要测试回调功能，可以通过[又拍云回调服务](https://hooks.upyun.com/)创建一个临时回调地址*

<a name="use-instructions"></a>
## 使用说明

<a name="install"></a>
### 安装

#### PHP >= 8.3

1.使用 `composer` 安装

推荐使用该方法安装，成为优雅的 PHPer :fire: 

建议使用速度很快的国内[全量镜像](https://pkg.phpcomposer.com/#how-to-use-packagist-mirror)([又拍云赞助](https://pkg.phpcomposer.com/#donation))

```
composer require ltqio/upyun-php-sdk
```


<a name="doc"></a>
### 文档

详细文档见 [doc.md](doc.md)

<a name="usage"></a>
### 示例

先初始化又拍云服务配置：

```php
require_once('vendor/autoload.php'); 

use Upyun\Upyun;
use Upyun\Config;
$serviceConfig = new Config('yourServiceName', 'yourOperatorName', 'yourOperatorPwd');
$client = new Upyun($serviceConfig);
```

#### 字符串写入又拍云服务器

```
$client->write('/save/path', 'file content');
```

#### 文件流写入又拍云服务器

```
$file = fopen('/local/path/file', 'r');
$client->write('/save/path', $file);
```

#### 使用并行式断点续传上传文件

```
$serviceConfig->setUploadType('BLOCK_PARALLEL');
$client = new Upyun($serviceConfig);
$file = fopen('/local/path/file', 'r');
$client->write('/save/path', $file);
```

#### 上传图片并转换格式为 `png`，详见[上传作图](http://docs.upyun.com/cloud/image/#_2)

```
$file = fopen('/local/path/image.jpg', 'r');
$client->write('/save/image.png', $file, array('x-gmkerl-thumb' => '/format/png'));
```

#### 下载文件并保存到本地 

```
$saveLocal = fopen('/local/path/image.jpg', 'w');
// 第二个参数不传时，read 方法将直接返回文件内容
$client->read('/remote/server/image.png', $saveLocal);
```

<a name="contribute"></a>
## 贡献代码
 1. Fork
 2. 为新特性创建一个新的分支
 3. 发送一个 pull request 到 master 分支

<a name="community"></a>
## 社区

 - [问答社区](http://segmentfault.com/upyun)
 - [微博](http://weibo.com/upaiyun)

<a name="license"></a>
## 许可证

UPYUN PHP-SDK 基于 MIT 开源协议

<http://www.opensource.org/licenses/MIT>

<a name="unofficial"></a>
## 🛡️ 关于本 Fork

- 本项目由社区开发者 fork 并适配新版本 PHP 及 Laravel；
- 不承诺完全兼容官方 API，如有疑问请优先参考官方文档；
- 欢迎 Issues 或 PR 协助维护。

---

# Changelog

> ⚠️ 本变更日志同时包含官方版本与本 Fork 的独立改动，详见各章节说明。

---

## [v1.0.0] - 2025-06-21 （Fork 首个稳定版本）
### 适配与改进（本 Fork）
- ✅ 兼容 PHP 8.3+
- ✅ 支持 Laravel 12+
- ✅ Guzzle 7 适配
- ✅ 完整 PHPUnit 测试覆盖
- ✅ 移除弃用接口与兼容性黑魔法
- ✅ 改进异常处理与测试结构

> 本版本为 [`upyun/php-sdk`](https://github.com/upyun/php-sdk) 的兼容性 Fork，
> 代码基于 v3.3.0 重构，并进行大量现代化处理。

---


## 3.3.0

- 增加同步视频处理功能

## 3.0.0

- 重写 API 接口，不兼容 2.x 版本
- 集合分块、刷新、视频预处理功能

## 2.2.0

- 增加 composer 支持，特别感谢 [@totoleo](https://github.com/totoleo) 将 `upyun/sdk` 仓库源修改为 UPYUN 官方项目地址
- 移除不再推荐使用的 API:`rmDir deleteFile readDir getWritedFileInfo`)，建议使用推荐方法替代
- note: `2.1.0` 版本之前已经被 [@totoleo](https://github.com/totoleo) 使用

## 2.0.0

- 使用1.0.x系列版本SDK的用户，注意原有部分方法已经不再推荐使用(`@deprecated`标注)，但是出于兼容考虑目前任然保留，建议更新升级程序使用新版SDK提供的方法。

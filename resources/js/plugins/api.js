import admin from '@/plugins/apis/admin'
import seller from '@/plugins/apis/seller'
import home from '@/plugins/apis/home'
import chat from '@/plugins/apis/chat'

const modulesFiles = require.context('./apis/modules', true, /\.js$/);
// 自动模块文件
const goodcatch = modulesFiles.keys().reduce((modules, modulePath) => Object.assign({}, modules, modulesFiles(modulePath).default), {});

export const api = {
    ...admin,
    ...seller,
    ...home,
    ...chat,
    ...goodcatch
}

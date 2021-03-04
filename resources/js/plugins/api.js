import admin from '@/plugins/apis/admin'
import seller from '@/plugins/apis/seller'
import home from '@/plugins/apis/home'
import chat from '@/plugins/apis/chat'
import goodcatch from '@/plugins/apis/goodcatch'
export const api = {
    ...admin,
    ...seller,
    ...home,
    ...chat,
    ...goodcatch
}

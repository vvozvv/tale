<template>
    <div class="table__content">
        <div class="table-item" v-for="user in user_articles">
            <div class="table-item__box" :title="moment(user.created_at).format('llll')">{{ moment(user.created_at).format('ll') }} </div>
            <div class="table-item__box" >{{ user.title }} </div>
            <div class="table-item__box" >{{ user.likes.length }} </div>
            <div class="table-item__box" >{{ user.comments.length }} </div>
            <div class="table-item__box" >{{ user.view_count }} </div>
            <div class="table-item__btns">
                <a href="" class="btn" title="Посмотреть статью"><svg width="23" height="23" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)" fill="#fff"><path d="M22.779 10.969l-2.19-2.19C15.4 3.617 7.596 3.617 2.438 8.776L.224 10.966a.755.755 0 00-.003 1.07l2.19 2.191c2.591 2.577 5.84 3.866 9.088 3.866 3.25 0 6.5-1.29 9.09-3.867l2.19-2.19a.754.754 0 000-1.067zm-3.256 2.188c-4.573 4.55-11.472 4.55-16.045.001l-1.652-1.652 1.677-1.659c4.554-4.554 11.442-4.554 16.019 0l1.655 1.655-1.654 1.655z"/><path d="M11.5 6.998a4.51 4.51 0 00-4.504 4.504 4.51 4.51 0 004.504 4.505 4.51 4.51 0 004.504-4.505A4.51 4.51 0 0011.5 6.998zm0 7.499a2.998 2.998 0 01-2.995-2.995A2.998 2.998 0 0111.5 8.508a2.998 2.998 0 012.994 2.994 2.998 2.998 0 01-2.994 2.995z"/><path d="M11.5 9.44v1.51c.31 0 .553.243.553.553 0 .31-.243.553-.553.553a.548.548 0 01-.554-.553h-1.51c0 1.138.926 2.063 2.064 2.063a2.066 2.066 0 002.063-2.063A2.066 2.066 0 0011.5 9.439z"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h23v23H0z"/></clipPath></defs></svg></a>
                <a href="" class="btn" title="Редактировать"><svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)" fill="#fff"><path d="M14.9 9.445a.61.61 0 00-.61.611v4.723H1.221V1.71h4.723a.61.61 0 100-1.221H.611a.61.61 0 00-.611.61v14.29c0 .338.273.611.61.611H14.9a.61.61 0 00.611-.61v-5.334a.61.61 0 00-.61-.61z"/><path d="M15.821 2.357L13.643.18a.61.61 0 00-.863 0L5.573 7.385a.61.61 0 00-.156.266l-.855 3.033a.611.611 0 00.754.754l3.033-.855a.612.612 0 00.266-.156l7.206-7.206a.61.61 0 000-.864zM7.864 9.45l-1.83.516.516-1.83 6.661-6.662 1.315 1.315L7.864 9.45z"/><path d="M6.457 7.364l-.864.864 2.178 2.177.863-.863-2.177-2.178z"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h16v16H0z"/></clipPath></defs></svg></a>
                <a href="" class="btn" title="Удалить статью"><svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.375 4.75h14.25M6.333 4.75V3.167a1.583 1.583 0 011.584-1.583h3.166a1.583 1.583 0 011.584 1.583V4.75m2.375 0v11.084a1.583 1.583 0 01-1.584 1.583H5.542a1.583 1.583 0 01-1.584-1.584V4.75h11.084zM7.917 8.709v4.75M11.083 8.709v4.75" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
            </div>
        </div>
    </div>

</template>

<script>
import moment from 'moment'
export default {
    props: {
        user_articles: {
            type: Array,
            default: () => {
                return []
            }

        }
    },
    data() {
        return {
            moment: moment
        }
    }
}
</script>


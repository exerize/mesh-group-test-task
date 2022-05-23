<template>
    <div  class="container">
            <table v-if="rows" class="table" style="width: 90%; margin-left: 5%">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="row in rows">
                    <th scope="row">{{ row.id }}</th>
                    <td>{{row.name}}</td>
                    <td>{{ row.date}}</td>
                </tr>
                </tbody>
            </table>
    </div>
</template>

<script>
export default {
    data () {
        return {
            rows: []
        }
    },
    mounted() {
        let that = this
        Echo.channel(`notification.rows`)
            .listen('.rows.add', (e) => {
                e.row.date =  new Date(e.row.date.date).toLocaleString()
                that.rows.push(e.row)
            });
    }
}
</script>

<template>
    <div class="rows-form" style="padding: 2.25rem; margin-top: 2%;">
        <div v-if="loaded" style="color: green">
            {{ this.response_message }}
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-left">Select xlsx/xls file</label>
            <div class="col-md-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile"
                           ref="file" @change="handleFileObject()">
                    <label class="custom-file-label text-left" for="customFile">{{ fileName }}</label>
                </div>
            </div>
            <div class="mb-3">
                <button @click.prevent="submit" type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            file: null,
            fileName: null,
            loaded: false,
            response_message: null
        }
    },

    methods: {
        submit() {
            let formData = new FormData()
            formData.append('excel', this.file)

            axios.post('/api/rows/', formData, {
                headers: {
                    'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2)
                }
            })
                .then(response => {
                    this.response_message = response.data.message
                    this.loaded = true
                    setTimeout(() => this.loaded = false, 2000)
                    this.file = null
                    this.fileName = null
                })
        },
        handleFileObject() {
            let file = this.$refs.file.files[0]
            if (!file) {
                return;
            } else if (file.type !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' &&
                file.type !== 'application/vnd.ms-excel') {
                alert('File not spreadsheet')
                return
            }
            this.file = file
            this.fileName = file.name
        }
    }
}
</script>

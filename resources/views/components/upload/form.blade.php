const response = await fetch('https://json.com', {
    method: 'get',
})
this.users = await response.json()
this.isLoading = false


const formData = new FormData()

formData.append('email', 'email@gmail.com')
formData.append('password', 'dsfsdfsee')
const response = await fetch('https://json.com', {
    method: 'post',
    body: formData,
    headers: {
        'authorization': 'value'
    }
})
this.users = await response.json()
this.isLoading = false

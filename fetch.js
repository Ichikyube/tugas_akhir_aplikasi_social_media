


async tampil() {
    const id = this.url[this.url.length-1]
    const data = new FormData()
    const respon = fetch(`http://127.0.0.1:8000/api/product/${id}`)
    .then(response => response.json())
    .then(data => {
        this.products = data.data;

    });
},

async getToken() {
    let token = localStorage.getItem('token')
    this.token = token;
},

async idUser(token) {
    const currentUser = fetch(`http://127.0.0.1:8000/api/me`, {
        method: 'get',
        headers: {
            'Authorization': `Bearer $(token)`
        }
    })
}

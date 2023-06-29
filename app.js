new Vue({
    el: '#app',
    data: {
        weight: 0,
        slug: '',
        result: null
    },
    methods: {
        calculatePrice() {
            fetch('/api/calculate-price', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    weight: this.weight,
                    slug: this.slug
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.price) {
                    this.result = data.price;
                } else if (data.error) {
                    this.result = data.error;
                }
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
});

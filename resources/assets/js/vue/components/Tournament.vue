    <script>
        export default  {
            props: ['list'],
            ready(){
                alert('Ready To Go2');
            },
            created(){
//                this.list = JSON.parse(this.list);
                $.getJSON('api/v1/tournaments', function(data){
                    console.log(data);
                    this.list = data;
                }.bind(this))
            }
        }
    </script>
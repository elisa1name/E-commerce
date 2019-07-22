import React,{Component} from 'react';
import axios from 'axios';  

export default class Profile extends Component {
    constructor() {
        super()
        this.state = {
            name : '',
            firstname : '', 
            email: '', 
            adress:'', 
            telephone: ''
        }
    }

    componentDidMount() {
        axios.get(`http://localhost:8000/api/profile`)
        .then(res => {
          console.log(res.data);
      })
      .catch(error => {
        console.log(error)
    });

    }
    render(){
        return(
            <div>
                <h1>Mon compte</h1>
            </div>
        );
    }

}
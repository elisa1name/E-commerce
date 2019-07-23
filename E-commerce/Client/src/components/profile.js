import React, { Component } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import '../assets/profile.css';

export default class Profile extends Component {
    constructor() {
        super()
        this.state = {
            name : '',
            firstname : '', 
            email: '', 
            adress:null, 
            telephone: null, 
        }
    }

    componentDidMount() {
        
        axios.get(`http://localhost:8000/api/profile`)
            .then(res => {
                console.log(res.data);
                this.setState({ name: res.data.name })
                this.setState({ firstname: res.data.firstname })
                this.setState({ email: res.data.email })
                this.setState({ adress: res.data.adress })
                this.setState({ telephone: res.data.telephone })
            })
            .catch(error => {
                console.log(error)
            })
    }

    isAuthenticated() {
        const token = localStorage.getItem('token');
        return token && token.length > 10;
    }

    render() {
        const adress = this.state.adress !== null;
        const telephone = this.state.telephone !== null;
        return (
            <div>
                <h1 style={{ textAlign: 'center' }}>Mon compte</h1>

                <div style={{ margin: '40px', padding: '50px' }}>
                    <h3>Mes informations</h3>
                    <div>
                        <h4>Prénom :</h4> <p> {this.state.firstname} </p>
                    </div>
                    <div>
                        <h4>Nom de famille :</h4> <p>{this.state.name} </p>
                    </div>
                    <div>
                        <h4>Email :</h4> <p> {this.state.email} </p>
                    </div>
                    <div>
                        <h5>Adresse :</h5>
                        {adress ? (<p>{this.state.adress}</p>) : (
                            <div>
                                <p style={{ padding: "10px" }}>Veuillez complèter votre adresse</p>

                                <Link to="/editUser">Modifier</Link>
                            </div>
                        )}
                    </div>
                    <div>
                        <h5> Téléphone :</h5>
                        {telephone ? (<p>{this.state.telephone}</p>) : (
                            <div>
                                <p style={{ padding: "10px" }}>Veuillez complèter votre numéro de téléphone</p>
                                <Link to="/editUser">Modifier</Link>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        );
    }
}
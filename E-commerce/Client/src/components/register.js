import React, { Component } from "react";
import { Button, FormGroup, FormControl, FormLabel } from "react-bootstrap";
import '../assets/register.css';
import { Container } from 'react-bootstrap';
import Footer from './footer.js';
import Photo from '../assets/photofond.jpg';
import axios from 'axios';

class Register extends Component {
  constructor(props) {
    super(props);

    this.state = {
      firstname:"",
      name:"",
      email: "",
      password: ""
    };
  }

  validateForm() {
    return this.state.email.length > 0 && this.state.password.length > 0;
  }

  handleChange = event => {
    this.setState({
      [event.target.id]: event.target.value
    });
  }

  handleSubmit = event => {
    event.preventDefault();

    const user = {
      firstname: this.state.firstname,
      name: this.state.name,
      email: this.state.email,
      password: this.state.password
    };
    console.log(user);// recupere bien

    axios.post(`http://127.0.0.1:8000/register`, user)
      .then(res => {
        console.log(res);
        console.log(res.data);
    })
      .catch(function (error) {
    console.log(error);
  });
  }

  render() {
    return (
      <div id="register">
        <form onSubmit={this.handleSubmit}>
        <p className="nouveau_client">Nouveau client ?</p>
        <FormGroup controlId="firstname" bsSize="large">
            <FormLabel className="label">Prenom</FormLabel>
            <FormControl
              className="control"
              autoFocus
              type="text"
              placeholder=".................."
              value={this.state.firstname}
              onChange={this.handleChange}
            />
          </FormGroup>
          <FormGroup controlId="name" bsSize="large">
            <FormLabel  className="label">Nom</FormLabel>
            <FormControl
             className="control"
              value={this.state.name}
              onChange={this.handleChange}
              type="text"
              placeholder=".................."
            />
          </FormGroup>
          <FormGroup controlId="email" bsSize="large">
            <FormLabel className="label">E-mail</FormLabel>
            <FormControl
              className="control"
              autoFocus
              type="email"
              placeholder=".................."
              value={this.state.email}
              onChange={this.handleChange}
            />
          </FormGroup>
          <FormGroup controlId="password" bsSize="large">
            <FormLabel className="label">Password</FormLabel>
            <FormControl
              className="control"
              value={this.state.password}
              onChange={this.handleChange}
              type="password"
              placeholder=".................."
            />
          </FormGroup>
          <p className="confidentialité">En créant un compte, vous acceptez les Conditions générales de vente de Teck-Box.
           Veuillez consulter notre Notice Protection de vos Informations Personnelles, notre Notice Cookies et notre
            Notice Annonces publicitaires basées sur vos centres d’intérêt..</p>
          <Button 
            className="button"
            block
            bsSize="large"
            disabled={!this.validateForm()}
            type="submit"
          >
            Inscrivez-vous
          </Button>
        </form>
        <Footer />
      </div>
    );
  }
}
export default Register;


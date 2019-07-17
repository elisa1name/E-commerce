import React, { Component } from "react";
import { Button, FormGroup, FormControl, FormLabel, } from "react-bootstrap";
import '../assets/login.css';
import { Container, Row, Col } from 'react-bootstrap';
import { BrowserRouter, Link, Route } from 'react-router-dom';

class Login extends Component {
  constructor(props) {
    super(props);

    this.state = {
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
  }

  render() {
    return (
      <div id="login">
        <form onSubmit={this.handleSubmit}>
        <p className="nouveau_client">Deja client ?</p>
          <FormGroup controlId="email"  bsSize="large">
            <FormLabel className="label1">E-mail</FormLabel>
            <FormControl
             className="control1"
              autoFocus
              type="email"
              placeholder=".................."
              value={this.state.email}
              onChange={this.handleChange}
            />
          </FormGroup>
          <FormGroup controlId="password" bsSize="large">
            <FormLabel  className="label1">Password</FormLabel>
            <FormControl
            className="control1"
              value={this.state.password}
              onChange={this.handleChange}
              type="password"
              placeholder=".................."
            />
          </FormGroup>
            <p className="confidentialité">En continuant, vous acceptez les Conditions d'utilisation et la Politique de confidentialité de Teck-Box.</p>
          <Button 
            className="button"
            block
            bsSize="large"
            disabled={!this.validateForm()}
            type="submit"
          >
            Identifiez-vous
          </Button>
        </form>
      </div>
    );
  }
}
export default Login;


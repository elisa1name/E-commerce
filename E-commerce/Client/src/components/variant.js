import React, { Component } from 'react';
import { Container } from 'react-bootstrap';
import { AxiosProvider, Request, Get, Delete, Head, Post, Put, Patch, withAxios, } from 'react-axios';
import axios from 'axios';
import PropTypes from "prop-types";
import TableRow from '@material-ui/core/TableRow';
import ReactList from 'react-list';
import { BrowserRouter, Link, Route } from 'react-router-dom';
import Produit from './produit';
import "react-responsive-carousel/lib/styles/carousel.css";
import { Carousel } from 'react-responsive-carousel';
import Search from 'react-search';

class Variant extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
      variant: [],
      id: this.props.match.params.id,
    }
  }
  
  
  componentDidMount(){
    axios.get(`http://localhost:8000/produit/${this.state.id}/variant`)
    .then(response => {
      console.log("data", response.data);
      this.setState({ 
        variant: response.data });
      })
      .catch(function (error) {
        console.log(error);
      })
    }  
    
    
    render() {
      return (
        
        <div >
        <p>Faite votre choix</p>
        {this.state.variant.map((variante) =>{
          return (
            <div>
              <Link to={`/variant/${variante.id}`} style={{color: '#20B2AA', textDecoration: 'none'}} key={variante} >
              {variante.name}
              </Link>
              {variante.mark}
            </div>
            )
          })}
          </div>
      )
      return (
          <div>
            <Search />
            <h1> La partie pannier </h1>
            <Carousel className="carousel">
            <div className="size">
              <img src={this.props.produits.fixed_picture} className="vue1" />
              <p className="legend">Legend 1</p>
            </div>
            <div className="size">
              <img src={this.props.produits.fixed_picture} className="vue1" />
              <p className="legend">Legend 2</p>
            </div>
            <div className="size">
              <img src={this.props.produits.fixed_picture} className="vue1"/>
              <p className="legend">Legend 3</p>
            </div>
            </Carousel>
            <div className="elementchoix"> 
              <tr className="detail">
                <th scope="col1">APPLE MAC PRO RETINA</th>
                <th scope="col2">Mug chapeau ananas en porcelaine imprimée</th>
                <th scope="col3">1000 €</th>
              </tr>
              <form>
                <select value={this.state.value} onChange={this.handleChange}>
                <option value="1">1</option>
                <option value="2">2</option>
                <option selected value="3">3</option>
                <option value="4">4</option>
                </select>
                <input type="submit" value="Ajoutez au panier"  className="ajouter"/>
              </form>
            </div>
          </div>
      )
        }
      } 
      export default Variant;
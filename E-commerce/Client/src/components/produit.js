import React, { Component } from 'react';
import { Container } from 'react-bootstrap';
import { AxiosProvider, Request, Get, Delete, Head, Post, Put, Patch, withAxios, } from 'react-axios';
import axios from 'axios';
import PropTypes from "prop-types";
import TableRow from '@material-ui/core/TableRow';
import ReactList from 'react-list';
import { BrowserRouter, Link, Route } from 'react-router-dom';

class Produit extends Component {
    
    constructor(props) {
        super(props);
        this.state = {
            produit: [],
            variant: [],
            id: this.props.match.params.id
        }
    }
    
    
    componentDidMount(){
        //console.log("here", this.state.id);
        axios.get(`http://localhost:8000/article/${this.state.id}/produit`)
        .then(response => {
            console.log("data", response.data);
            this.setState({ 
                produit: response.data });
                
                //console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
        }  
        
        
        render() {
            
            return (
             
            <div >
            <p>Choix de votre produit</p>
            {this.state.produit.map((produits) =>{
                return (
                    <div>
                    <Link to={`/variant/${produits.id}`} style={{color: '#20B2AA', textDecoration: 'none'}} key={produits} >
                    {produits.name}
                    </Link>
                    <img   src={produits.picture} alt="indisponible image" width="350px" height="250px"/>
                    </div>
                    )
                    
                })}
                </div>
                )
                
            }
        } 
        export default Produit;
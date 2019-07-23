import React, { Component } from 'react';
import { Container } from 'react-bootstrap';
import { AxiosProvider, Request, Get, Delete, Head, Post, Put, Patch, withAxios, } from 'react-axios';
import axios from 'axios';
import PropTypes from "prop-types";
import TableRow from '@material-ui/core/TableRow';
import ReactList from 'react-list';
import Articles from '../components/articles.js';
import ReactDOM from 'react-dom';
import { BrowserRouter, Link, Route } from 'react-router-dom';

class Categorie extends Component {
  
  constructor(props, id) {
    super(props);
    //this.id = id;
    this.state = {
      category: [],
      //category_id: [],
       //justClicked: null,
      //redirect: false
    };
  }

    /*setRedirect = () => {
      this.setState({
        redirect: true
      })
    };
  

    renderRedirect (){
      if (this.state.redirect) {
        return <Redirect to='/articles'/>
      }
    };


*/
  
  componentDidMount(){
    axios.get('http://localhost:8000/category')
    .then(response => {
      console.log(response.data);
      this.setState({ 
        category: response.data,
      });
      console.log(this.props);
      
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    })
  }  
  
      
      render() {  
        return (
          
          <div >
          <p>Bienvenu sur Categorie</p>
          {this.state.category.map((categorie) => {
            return (
              <div>
              <Link to={`/articles/${categorie.id}`}  key={categorie} >
              {categorie.name}
              </Link>
              </div>
              )
    
            })}
            </div>
            )
            
          }
        } 
export default Categorie;
        
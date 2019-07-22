import React, { Component } from 'react';
import { Container } from 'react-bootstrap';
import { AxiosProvider, Request, Get, Delete, Head, Post, Put, Patch, withAxios, } from 'react-axios';
import axios from 'axios';
import PropTypes from "prop-types";
import TableRow from '@material-ui/core/TableRow';
import ReactList from 'react-list';
import Articles from '../components/articles.js';

class Categorie extends Component {
  
  constructor(props) {
    super(props);
    this.handleClick = this.handleClick.bind(this);
    this.state = {
      category: [],
      //justClicked: null,
    }
  }
  
  handleClick(e) {
    this.setState({
      justClicked: e.target.dataset.articles
    });
  }
  
  componentDidMount(){
    axios.get('http://localhost:8000/category')
    .then(response => {
      console.log(response.data);
      this.setState({ 
        category: response.data,
      });
      
      console.log(response);
    })
    .catch(function (error) {
      console.log(error);
    })
  }  
  
  
  render() {  
    
    // integration du code dans une function 
    /* function ListCategory(props) {
      const category = props.category;
      return (
        <ul>
        {props.category.map((categorie) =>
          <li key={categorie.id}>
          {categorie.title}
          </li>
          )}
          </ul>
          );
          
          return (
            <div>
            {category}
            </div>
            );
          }
          */
          
          
          //code qui fonctionne mais pas dans une fonction 
          /* return (
            function List (props){
              const category = props.category;
              {this.state.category.map((categorie) => {
                return (
                  <li  key={categorie} onClick={() => this.handleClick(this.articless.id)}>
                  {categorie.name}
                  </li>
                  )
                })}
              })
            }
          }
          */
          
          
          
          return (
            <div >
            <p>Bienvenu sur Categorie</p>
            {this.state.category.map((categorie) => {
              return (
                <li  key={categorie} onClick={() => this.handleClick(this.state.articles)}>
                {categorie.name}{categorie.picture}
                </li>
                )
              })}
              </div>
              )
            }
          }
          
        
            export default Categorie;
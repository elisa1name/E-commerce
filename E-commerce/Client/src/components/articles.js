import React, { Component } from 'react';
import { Container } from 'react-bootstrap';
import { AxiosProvider, Request, Get, Delete, Head, Post, Put, Patch, withAxios, } from 'react-axios';
import axios from 'axios';
import PropTypes from "prop-types";
import TableRow from '@material-ui/core/TableRow';
import ReactList from 'react-list';


class Articles extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
      articles: [],
      id: this.props.match.params.id
    }
  }

  
  componentDidMount(){
    //console.log("here", this.state.id);
    axios.get(`http://localhost:8000/category/${this.state.id}/article`)
    .then(response => {
      console.log("data", response.data);
      this.setState({ 
        articles: response.data });
        
        //console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      })
    }  
    
    
    render() {
      return (
        <div >
          <p>Bienvenu sur Articles</p>
          {this.state.articles.map((articless) => {
            return (
              <li>{articless.name}</li> 
            )
          })}
        </div>
      )
    }
}
      
      export default Articles;
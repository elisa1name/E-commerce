import React, { Component } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

export default class Users extends Component {

    constructor(props) {
        super(props)
        this.state = {
            users: [],

        }
    }

    componentDidMount() {

        axios.get(`http://localhost:8000/api/admin/users`)
            .then(res => {
                console.log(res.data);
                this.setState({ users: res.data })

            })
            .catch(error => {
                console.log(error)
            })
    }

    render() {
        const users = this.state.users
        return (
            <div>
                <h1 style={{ textAlign: 'center' }}>UserList</h1>
                <ul>
                    {users.map(item => (
                        <li key={item.id}>
                            <div>{item.id}</div>
                            <div>{item.firstname}</div>
                            <div>{item.name}</div>
                            <div>{item.adress}</div>
                            <div>{item.telephone}</div>
                        </li>
                    ))}
                </ul>


            </div>


        )
    }







}

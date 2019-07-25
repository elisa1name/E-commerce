import React from 'react';
import Navbar from './components/navbar.js';
import Search from './components/search.js';
import Login from './components/login.js';
import Register from './components/register.js';
import EditUser from './components/edit_user.js'
import { BrowserRouter, Link, Route } from 'react-router-dom';
import classNames from 'classnames';
import Tooltip from "react-simple-tooltip";
import Profil from './assets/profil.png';
import pngInfo from './assets/infos.png';
import pngPanier from './assets/panier.png';
import pngHome from './assets/home.png';
import logout from './assets/logout.png';
import './App.css';
import Contenu from './components/contenu.js';
import Categorie from './components/categorie.js';
import Nouveauté from './components/nouveauté.js';
import Coeur from './components/coeur.js';
import Profile from './components/profile.js';
import Contact from './components/contact.js';
import Conditions from './components/conditions.js';
import Protection from './components/protection.js';
import Aide from './components/aide.js';
import Admin from './components/admin/users.js'
import Centres from './components/centres.js';
import Footer from './components/footer.js';
import axios from 'axios';

class App extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            isAuthenticated: null,
            name: '',
            firstname: '',
            email: '',
            adress: '',
            telephone: '',
            roles: '',
            isAdmin: false,
        }
        this.changeData = this.changeData.bind(this)

        axios.interceptors.request.use(
            (config) => {
                let token = localStorage.getItem('token');

                if (token) {
                    config.headers.Authorization = `Bearer ${token}`
                }

                return config;
            },
            (error) => {
                console.log(error);
                return Promise.reject(error);
            }
        );
    }

    changeData(data) {
        console.log(data);
        this.setState({ isAuthenticated: data })
    }

    componentDidMount() {
        //let result = this.child.current.isAuthenticated();
        let token = localStorage.getItem('token');
        if (token && token.length > 10) {
            this.setState({ isAuthenticated: true })
        } else {
            this.setState({ isAuthenticated: false })
        }

       
        axios.get(`http://localhost:8000/api/profile`)
            .then(res => {
                console.log(res.data);
                this.setState({ name: res.data.name })
                this.setState({ firstname: res.data.firstname })
                this.setState({ email: res.data.email })
                this.setState({ adress: res.data.adress })
                this.setState({ telephone: res.data.telephone })
                this.setState({ roles: res.data.roles })
                console.log(this.state.roles[0])

                if (this.state.roles[0] === "ROLE_ADMIN") {
                    this.setState({ isAdmin: true })
                    
                } else {
                    this.setState({ isAdmin: false })
                }

            })
            .catch(error => {
                console.log(error)
            });
    }


    handleLogout = () => {
        this.setState({ isAuthenticated: false })
        this.setState({ isAdmin: false });
        localStorage.removeItem('token');
    }

    render() {
        return (
            <BrowserRouter>
                <div>
                    <nav class="navbar navbar-expand-sm bg-light">
                        <h1 class="logo">TECK-BOX</h1>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <Tooltip content="Accueil" placement="bottom" background="rgb(53, 56, 47)">
                                    <Link to="/"><img src={pngHome} widht="100" height="50" alt="infos" /></Link>
                                </Tooltip>
                            </li>

                            {this.state.isAuthenticated ? (

                                <li class="nav-item">
                                    <Tooltip content="Profile" placement="bottom" background="rgb(53, 56, 47)" color="#FFF">
                                        <Link style={{ marginRight: "15px" }} to="/moncompte" ><img src={Profil} widht="100" height="50" alt="profil" /></Link>
                                    </Tooltip>
                                    {this.state.isAdmin && (
                                        <Tooltip content="admin" placement="bottom" background="rgb(53, 56, 47)" color="#FFF">
                                            <Link style={{ marginRight: "15px" }} to="/admin/users" ><img src={Profil} widht="100" height="50" alt="profil" /></Link>
                                        </Tooltip>

                                    )}
                                    <Tooltip content="Deconnexion" placement="bottom" background="rgb(53, 56, 47)" color="#FFF">
                                        <Link onClick={this.handleLogout} to="/" ><img src={logout} widht="100" height="50" alt="deconnexion" /></Link>
                                    </Tooltip>
                                </li>

                            ) : (
                                    <li class="nav-item">
                                        <Tooltip content="Login/Register" placement="bottom" background="rgb(53, 56, 47)" border="#000" color="#fff">
                                            <Link to="/auth" ><img src={Profil} widht="100" height="50" alt="profil" /></Link>
                                        </Tooltip>
                                    </li>

                                )}

                            <li class="nav-item">
                                <Tooltip content="Panier" placement="bottom" background="rgb(53, 56, 47)">
                                    <Link to="/panier"><img src={pngPanier} widht="100" height="50" alt="infos" /></Link>
                                </Tooltip>
                            </li>

                            <li class="nav-item">
                                <Tooltip content="Info" placement="bottom" background="rgb(53, 56, 47)" color="#FFF">
                                    <Link to="/infos"><img src={pngInfo} widht="100" height="50" alt="infos" /></Link>
                                </Tooltip>
                            </li>
                        </ul>
                    </nav>
                    <hr />
                    <div className="main-route-place">
                        <Route exact path="/" component={Home} />
                        <Route path="/Infos" component={Infos} />
                        <Route path="/panier" component={Panier} />
                        <Route path="/categorie" component={Categorie} />
                        <Route path="/nouveauté" component={Nouveauté} />
                        <Route path="/coeur" component={Coeur} />
                        <Route path="/contact" component={Contact} />
                        <Route path="/conditions_d'utilisation" component={Conditions} />
                        <Route path="/protection_de_vos_informations_personnelles" component={Protection} />
                        <Route path="/aide" component={Aide} />
                        <Route path="/centres_d’intérêt" component={Centres} />
                        <Route path="/auth" render={() => <Login changeFunction={this.changeData} />} />
                        <Route path="/auth" component={Register} />

                        {this.state.isAuthenticated && (
                            <div>
                                <Route path="/moncompte" component={Profile} />
                                <Route path="/editUser" component={EditUser} name={this.state.name} firstname={this.state.firstname} email={this.state.email} adress={this.state.adress} telephone={this.state.telephone} />
                                {this.state.isAdmin && (
                                <Route path="/admin/users" component={Admin} />
                                )}
                            </div>
                        )
                        }
                    </div>
                </div>
            </BrowserRouter>
        );
    }
}

class Home extends React.Component {

    render() {
        return (
            <div>
                {/* <Navbar /> */}
                <Search />
                <Contenu />
            </div>
        );
    }
}

class Infos extends React.Component {
    render() {
        return (
            <div>
                <Search />
                <h2>coucou c'est nous</h2>
                <h1> AMINA HAKIMA ELISA HADY</h1>
            </div>
        );
    }
}

class Panier extends React.Component {
    render() {
        return (
            <div>
                <Search />
                <h1> La partie pannier </h1>
            </div>
        );
    }
}



export default App;
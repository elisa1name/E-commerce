import React from 'react';
import Navbar from './components/navbar.js';
import Search from './components/search.js';
import Login from './components/login.js';
import Register from './components/register.js';
import { BrowserRouter, Link, Route } from 'react-router-dom';
import classNames from 'classnames';
import Tooltip from "react-simple-tooltip";
import Profil from './assets/profil.png';
import pngInfo from './assets/infos.png';
import pngPanier from './assets/panier.png';
import pngHome from './assets/home.png';
import './App.css';
import Contenu from './components/contenu.js';
import Categorie from './components/categorie.js';
import Nouveauté from './components/nouveauté.js';
import Coeur from './components/coeur.js';
import Contact from './components/contact.js';
import Conditions from './components/conditions.js';
import Protection from './components/protection.js';
import Aide from './components/aide.js';
import Centres from './components/centres.js';
import Footer from './components/footer.js';


class App extends React.Component {
 
  render()  {
    return  (
      <BrowserRouter>
        <div>
        <nav class="navbar navbar-expand-sm bg-light">
        <h1 class="logo">TECK-BOX</h1>
          <ul class="navbar-nav">
            <li class="nav-item">
            <Tooltip content="Accueil" placement="bottom" background="rgb(53, 56, 47)">
              <Link to="/"><img src={pngHome} widht="100" height="50" alt="infos"/></Link>
            </Tooltip>
            </li>
            <li class="nav-item">
              <Tooltip content="Login/Register" placement="bottom" background="rgb(53, 56, 47)" border="#000" color="#fff">
                <Link to="/profil"><img src={Profil} widht="100" height="50" alt="profil"/></Link>
              </Tooltip>

              <li class="nav-item">
              <Tooltip content="Panier" placement="bottom" background="rgb(53, 56, 47)">
                <Link to="/panier"><img src={pngPanier} widht="100" height="50" alt="infos"/></Link>
              </Tooltip>
            </li>
            
            </li>
            <li class="nav-item">
            <Tooltip content="Info" placement="bottom" background="rgb(53, 56, 47)" color="#FFF">
                <Link to="/infos"><img src={pngInfo} widht="100" height="50" alt="infos"/></Link>
            </Tooltip>
            </li>
           </ul>
          </nav>
          <hr />
          <div className="main-route-place">
            <Route exact path="/" component={Home} />
            <Route path="/profil" component={Login} />
            <Route path="/profil" component={Register} />
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
          </div>
        </div>
      </BrowserRouter>
    );
  }
}
 
class Home extends React.Component {
 
  render()  {
    return (
      <div>
        {/* <Navbar /> */}
        <Search />
        <Contenu />
      </div>
    );
  }
}
 
class Infos  extends React.Component {
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

class Panier  extends React.Component {
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
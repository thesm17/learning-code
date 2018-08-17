import React, { Component } from 'react';
import './App.css';
import { Spread } from './spread/Spread';


class App extends Component {


  render() {
    return (
      <div className="App">
        <header className="App-header">
          <h1 className="App-title">Welcome to React</h1>
        </header>
       <Spread />
      </div>
    );
  }
}

export default App;

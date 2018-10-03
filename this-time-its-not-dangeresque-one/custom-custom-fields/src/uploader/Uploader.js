import React, { Component } from 'react';
import PropTypes from 'prop-types';

export class Uploader extends Component {
  constructor(props) {
    super(props);
    this.state = {

    }
  }

 handleChange(){}

  render() {
    return (<form type="file" onChange={this.handleChange.bind(this)}>Will this print on the button?</form>)
  }

}
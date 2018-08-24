import React, { Component } from 'react';
import glamorous from 'glamorous';
import PropTypes from 'prop-types';

function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}

const phoneOnly = '@media only screen and (max-width: 479px)',
      mediumMedia = '@media only screen and (min-width: 480px)',
      largeMedia = '@media only screen and (min-width: 800px)';

const Container = glamorous.div({
  padding: '2px',
  borderWidth: '15px 0px 0px 0px',
  borderStyle: 'solid',
  display: "flex",
  flexFlow: "row wrap",
  justifyContent: "center",
  height: "300px",
  alignContent: "center",
});

const Thumbnail = glamorous.div({
  display: 'grid',  
  justifyItems: 'stretch',
  minHeight:'200px',
  maxHeight: '300px',
  
  justifyContent: 'center',
  backgroundColor: 'yellow',
  [phoneOnly]: {
    backgroundColor: 'pink',
    flex: '1 1 0',
    },
  [mediumMedia]: {
    backgroundColor: "orange",
    flex: '2',
  },
},
 // props => ({backgroundImage: `url(${props.source})`}),
);

const Overlay = glamorous.div({
  //width: '10px',
  position: 'relative',
  bottom: '20%',
  backgroundColor: 'rgba(0,102,255,0.6)',
  borderRadius: '5px',
  padding: '3px',
  margin: '0px 8px 10px 8px',  
  borderLeft: "5px solid blue",
});

const ThumbImg = glamorous.img({
  maxHeight: '300px',
  maxWidth: '100%',
  overflow: 'hidden',
})

const Righty = glamorous.div({
  padding: '20px',
    [phoneOnly]: {
    backgroundColor: "orange",
  },
  [mediumMedia]: {
    overflow: 'hidden',
    backgroundColor: `${getRandomColor()}`,
    flex: '3',

  }},
  props => ({backgroundColor: `${props.colorr}`})
);




export class SpreadContainer extends Component{
  constructor(props) {
    super(props);
  }
  
  render() {
    return (
      <Container>
         <Thumbnail>
            <ThumbImg src={this.props.imgUrl}/>
            <Overlay>{this.props.desc}</Overlay>
        </Thumbnail>
        <Righty>{this.props.formattedBlog}</Righty>
      </Container>
    )
  }
}

SpreadContainer.propTypes = {
  imgUrl: PropTypes.string.isRequired,
  desc: PropTypes.string.isRequired,
  formattedBlog: PropTypes.string.isRequired //want to pass in a JSON object in the future, but for now will just write the file and then JSON-ify it
};

export default SpreadContainer.defaultPropts = {
  imgUrl:"https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&h=350",
  desc:"A wonderful picture of a cat. Don't you love to look at this beaut?",
  formattedBlog: JSON.stringify('<h1>Look at this awesome Blog!</h1><p>We will talk so much about blogging and kittens on this blog.</p>')
};
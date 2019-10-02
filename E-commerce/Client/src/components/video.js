import React, { Component } from 'react';
import { Container, Row, Col } from 'react-bootstrap';
import Contact from './contact.js';
import VideoCover from 'react-video-cover';

class VideoBackground extends Component {
    state = {
        resizeNotifier: () => {},
    }
    
    render() {
        const videoOptions = {
            src: require('./Computer.mp4'),
            autoPlay: true,
            loop: true,
            muted: true
        };
        const stylevideo = {
            width: '150vw',
            height: '50vh',
            position: 'absolute',
            margin: 'auto',
            top: '-25vh',
            left: '-25vw',
            marginTop: '362px',
            zIndex: -2,
        };
        return (
            <div style={stylevideo} >
            <VideoCover
            videoOptions={videoOptions}
            remeasureOnWindowResize
            getResizeNotifier={resizeNotifier => {
                this.setState({
                    resizeNotifier,
                });
            }}
            />
            </div>
            );
        }
    }
    export default VideoBackground;
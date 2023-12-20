import React from 'react';
import PropTypes from 'prop-types';
const CardImagen = (props) => {
    return (
        <img src={props.urlToImage} className="card-img-top" alt={props.title} />
    );
};
CardImagen.propTypes = {
    urlToImage: PropTypes.string.isRequired,
    title: PropTypes.string.isRequired,
};
export default CardImagen;
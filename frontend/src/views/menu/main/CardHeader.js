import React from 'react';
import PropTypes from 'prop-types';
const CardHeader = (props) => {
    return (
        <div className="card-header d-flex justify-content-between align-items-center">
            <span>{props.title}</span>
            <button className="btn btn-sm btn-danger" onClick={() => props.setFlagNews(false)}>X</button>
        </div>
    );
}
CardHeader.propTypes = {
    title: PropTypes.string.isRequired,
    setFlagNews: PropTypes.func.isRequired,
};
export default CardHeader;

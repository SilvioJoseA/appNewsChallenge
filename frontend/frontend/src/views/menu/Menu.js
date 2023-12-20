import React, { useEffect, useState } from "react";
import PropTypes from 'prop-types';
import { useNavigate } from 'react-router-dom'; 
import Filter from "./filter/Filter";
import Footer from "./footer/Footer";
import Header from "./header/Header";
import MainContainer from "./main/MainContainer";
import './styles/styles.css';
import { connectionData, endpoint } from "../../connection/apiConnection";

const Menu = () => {
    const [data, setData] = useState([]);
    const [keyWordFilter, setKeyWordFilter] = useState('');
    const [dateFilter, setDateFilter] = useState('');
    const [categoryFilter, setCategoryFilter] = useState('');
    const [sourceFilter, setSourceFilter] = useState('');
    const [settings, setSettings] = useState({});
    const userString = localStorage.getItem('user');
    const user = userString ? JSON.parse(userString) : null;
    const userId = user?.id;
    const navigate = useNavigate();

    useEffect(() => {
        fetchDataSettings();
    }, []);

    useEffect(() => {
        setSettings({
            "user_id": userId,
            "filter_keyword": keyWordFilter,
            "filter_date": dateFilter,
            "filter_category": categoryFilter,
            "filter_source": sourceFilter
        });
    }, [keyWordFilter, dateFilter, categoryFilter, sourceFilter]);

    useEffect(() => {
        if (userId) {
            fetchDataNews();
        } else {
            navigate('/login');
        }
    }, [settings]);

    const fetchDataNews = async () => {
        try {
            const result = await connectionData(endpoint, 'alpha', 'POST', { ...settings });
            setData(result);
        } catch (error) {
            console.error(error);
        }
    };

    const fetchDataSettings = async () => {
        try {
            const result = await connectionData(endpoint, 'settings', 'POST', { id: parseInt(userId) });
            if (result) {
                setKeyWordFilter(result.filter_keyword || '');
                setDateFilter(result.filter_date || '');
                setCategoryFilter(result.filter_category || '');
                setSourceFilter(result.filter_source || '');
            }
        } catch (error) {
            console.error(error);
        }
    };

    return (
        <div className="menu-component vh-100 bg bg-dark d-flex flex-column justify-content-center align-items-center">
            <div className="row h-100 w-100 menu-component">
                <div className="col h-100 w-100 d-flex flex-column justify-content-center align-items-center">
                    <Header settings={settings} keyWordFilter={keyWordFilter} setKeyWordFilter={setKeyWordFilter} />
                    <Filter dateFilter={dateFilter} categoryFilter={categoryFilter} sourceFilter={sourceFilter} setDateFilter={setDateFilter} setCategoryFilter={setCategoryFilter} setSourceFilter={setSourceFilter} />
                    <MainContainer data={data} />
                    <Footer />
                </div>
            </div>
        </div>
    );
};

Menu.propTypes = {
    data: PropTypes.array.isRequired,
    keyWordFilter: PropTypes.string.isRequired,
    dateFilter: PropTypes.string.isRequired,
    categoryFilter: PropTypes.string.isRequired,
    sourceFilter: PropTypes.string.isRequired,
    settings: PropTypes.object.isRequired,
};

export default Menu;

import { Component } from 'react';
import LegacyItemForm from './LegacyItemForm';
import BeneficiaryList from './BeneficiaryList';

class VaultManager extends Component {
    constructor(props) {
        super(props);
        this.state = {
            activeTab: 'items',
            showAddItem: false
        };
    }

    render() {
        return (
            <div className="vault-manager">
                <div className="tab-navigation">
                    <button onClick={() => this.setState({ activeTab: 'items' })}>
                        Vault Items
                    </button>
                    <button onClick={() => this.setState({ activeTab: 'beneficiaries' })}>
                        Beneficiaries
                    </button>
                </div>
                
                {this.state.activeTab === 'items' && (
                    <div className="vault-items">
                        <button onClick={() => this.setState({ showAddItem: true })}>
                            Add New Item
                        </button>
                        {this.state.showAddItem && <LegacyItemForm />}
                    </div>
                )}
                
                {this.state.activeTab === 'beneficiaries' && (
                    <BeneficiaryList />
                )}
            </div>
        );
    }
}

import icon from "./icon";

const {__, sprintf} = wp.i18n;
const {Component, createRef} = wp.element;
const apiFetch = wp.apiFetch;
const {addQueryArgs} = wp.url;
const {Placeholder, Spinner} = wp.components;

export function rendererPath(block, attributes = null, urlQueryArgs = {}) {
	return addQueryArgs(`/wp/v2/block-renderer/${block}`, {
		context: "edit",
		...(null !== attributes ? {attributes} : {}),
		...urlQueryArgs
	});
}

class ATServerSideRender extends Component {
	constructor(props) {
		super(props);
		this.state = {
			response: null
		};
		this.atpRef = createRef();
	}

	componentDidMount() {
		this.isStillMounted = true;
		this.fetch(this.props);
	}

	fetch(props) {
		if (!this.isStillMounted) {
			return;
		}
		if (null !== this.state.response) {
			this.setState({response: null});
		}
		const {block, attributes = null, urlQueryArgs = {}} = props;

		const path = rendererPath(block, attributes, urlQueryArgs);
		// Store the latest fetch request so that when we process it, we can
		// check if it is the current request, to avoid race conditions on slow networks.
		const fetchRequest = (this.currentFetchRequest = apiFetch({path})
			.then(response => {
				if (
					this.isStillMounted &&
					fetchRequest === this.currentFetchRequest &&
					response
				) {
					this.setState({response: response.rendered});
				}
			})
			.catch(error => {
				if (this.isStillMounted && fetchRequest === this.currentFetchRequest) {
					this.setState({
						response: {
							error: true,
							errorMsg: error.message
						}
					});
				}
			}));
		return fetchRequest;
	}

	render() {
		const response = this.state.response;
		const {
			className,
			EmptyResponsePlaceholder,
			ErrorResponsePlaceholder,
			LoadingResponsePlaceholder
		} = this.props;

		if (response === "") {
			return <EmptyResponsePlaceholder response={response} {...this.props} />;
		} else if (!response) {
			return <LoadingResponsePlaceholder response={response} {...this.props} />;
		} else if (response.error) {
			return <ErrorResponsePlaceholder response={response} {...this.props} />;
		}

		let wrapperClass =
			typeof className !== "undefined" && className
				? "awsm-team-block-content-wrapper " + className
				: "awsm-team-block-content-wrapper";
		return (
			<div
				ref={this.atpRef}
				className={wrapperClass}
				dangerouslySetInnerHTML={{__html: response}}
			/>
		);
	}
}

ATServerSideRender.defaultProps = {
	EmptyResponsePlaceholder: ({className}) => (
		<Placeholder
			label={__("AWSM Team", "awsm-team-pro")}
			icon={icon.block}
			className={className}
		>
			{__("No Team found!", "awsm-team-pro")}
		</Placeholder>
	),
	ErrorResponsePlaceholder: ({response, className}) => {
		const errorMessage = sprintf(
			// translators: %s: error message describing the problem
			__("Error loading the Team: %s", "awsm-team-pro"),
			response.errorMsg
		);
		return (
			<Placeholder
				label={__("Team", "awsm-team-pro")}
				icon={icon.block}
				className={className}
			>
				{errorMessage}
			</Placeholder>
		);
	},
	LoadingResponsePlaceholder: ({className}) => {
		return (
			<Placeholder className={className}>
				<Spinner />
			</Placeholder>
		);
	}
};

export default ATServerSideRender;
